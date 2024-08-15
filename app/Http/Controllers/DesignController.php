<?php

namespace App\Http\Controllers;

use App\Models\DesignModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DesignController extends Controller
{
    protected $designModel;

    public function __construct(DesignModel $designModel)
    {
        $this->designModel = $designModel;
    }

    public function index()
    {
        $designs = $this->designModel->all()->load('images');

        return Inertia::render('Designs', [
            'designs' => $designs
        ]);
    }

    public function create()
    {
        return Inertia::render('Designs/Form');
    }

    public function store(Request $request)
    {
        try {
            request()->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $this->designModel->create($request->all());

            return response()->json([
                'design_id' => $this->designModel->design_id,
                'message' => 'Design created successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $design = $this->designModel->find($id)->load('images');

        return Inertia::render('Designs/Form', [
            'design' => $design
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            request()->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $design = $this->designModel->find($id);
            $design->update($request->all());

            return response()->json([
                'design_id' => $design->design_id,
                'message' => 'Design updated successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $design = $this->designModel->find($id);
            $design->delete();

            return response()->json([
                'message' => 'Design deleted successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $design = $this->designModel->find($id)->load('images');

        return Inertia::render('Designs/Show', [
            'design' => $design
        ]);
    }

    public function storeImages(Request $request, $id)
    {
        try {
            request()->validate([
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            $design = $this->designModel->find($id);

            $storagedImages = [];

            foreach ($request->file('images') as $image) {
                $name = $id . '_' . time() . '.' . $image->extension();
            }
            $path = $image->storeAs('designs', $name, 'public');

            $storagedImages[] = [
                'path' => $path,
                'name' => $name

            ];

            $design->images()->createMany($storagedImages);

            return response()->json([
                'design_id' => $design->design_id,
                'message' => 'Images uploaded successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
