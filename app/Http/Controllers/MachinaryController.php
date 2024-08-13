<?php

namespace App\Http\Controllers;

use App\Models\MachinaryModel;
use Illuminate\Http\Request;

class MachinaryController extends Controller
{
    protected $machinaryModel;

    public function __construct(MachinaryModel $machinaryModel)
    {
        $this->machinaryModel = $machinaryModel;
    }

    public function index()
    {
        $machinaries = $this->machinaryModel->all();
        return view('machinary.index', compact('machinaries'));
    }

    public function create()
    {
        return view('machinary.create');
    }

    public function store(Request $request)
    {
        $machinary = $this->machinaryModel->create($request->all());
        return redirect()->route('machinary.index');
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
        $machinary = $this->machinaryModel->find($id);
        $machinary->update($request->all());
        return redirect()->route('machinary.index');
    }

    public function destroy($id)
    {
        $machinary = $this->machinaryModel->find($id);
        $machinary->delete();
        return redirect()->route('machinary.index');
    }

    public function addImage(Request $request, $id)
    {
        $machinary = $this->machinaryModel->find($id);
        $machinary->images()->create($request->all());
        return redirect()->route('machinary.show', $id);
    }

    public function deleteImage($id, $imageId)
    {
        $machinary = $this->machinaryModel->find($id);
        $machinary->images()->find($imageId)->delete();
        return redirect()->route('machinary.show', $id);
    }
}
