<?php

namespace App\Http\Controllers;

use App\Models\MachinaryModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MachinaryController extends Controller
{
    protected $machinaryModel;

    public function __construct(MachinaryModel $machinaryModel)
    {
        $this->machinaryModel = $machinaryModel;
    }

    public function index()
    {
        $machinaries = $this->machinaryModel->all()->load('images');
        return Inertia::render('Machinaries', ['machinaries' => $machinaries]);
    }

    public function create()
    {
        return view('machinary.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'El campo nombre es requerido',
            'description.required' => 'El campo descripción es requerido',
        ]);

        try {
            $machinary = $this->machinaryModel->create($request->all());


            return response()->json([
                'success' => true,
                'machinary_id' => $machinary->machinary_id,
            ]);
        } catch (\Exception $e) {

            return $e;
        }
    }

    public function show($id)
    {
        $machinary = $this->machinaryModel->find($id);
        return view('machinary.show', compact('machinary'));
    }

    public function edit($id)
    {
        $machinary = $this->machinaryModel->find($id);
        return view('machinary.edit', compact('machinary'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
            ], [
                'name.required' => 'El campo nombre es requerido',
                'description.required' => 'El campo descripción es requerido',
            ]);

            $machinary = $this->machinaryModel->find($id);
            $machinary->update($request->all());
            return response()->json([
                'success' => true,
                'machinary_id' => $machinary->machinary_id,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }

    public function destroy($id)
    {
        $machinary = $this->machinaryModel->find($id);
        $machinary->delete();
        return redirect()->route('machinary.index');
    }

    public function storeImages(Request $request, $id)
    {
        try {

            $request->validate([
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
            $machinary = $this->machinaryModel->find($id);
            $images = $request->file('images');
            $storagedImages = [];
            foreach ($images as $image) {
                $name = $id . '_' . time() . '.' . $image->extension();
                $path = $image->storeAs('machinary', $name, 'public');
                $storagedImages[] = [
                    'name' => $name,
                    'path' => $path,
                ];
            }

            $machinary->images()->createMany($storagedImages);

            return response()->json([
                'success' => true,
                'machinary_id' => $machinary->machinary_id,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }

    public function deleteImage($id, $imageId)
    {
        $machinary = $this->machinaryModel->find($id);
        $machinary->images()->find($imageId)->delete();
        return redirect()->route('machinary.show', $id);
    }
}
