<?php

// app/Http/Controllers/ImageController.php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
    }
    public function upload(Request $request)
    {
        // Validar que se haya subido al menos una imagen
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'project_id' => 'required|integer'
        ]);
        //set name of the image with the project_id and the current time

        // Opcional: Guardar información en la base de datos, etc.

        // Procesar cada imagen
        $savedImages = [];
        foreach ($request->file('images') as $image) {
            //set the name of the image with the project_id and the current time
            $imageName = $request->project_id . '_' . time() . '.' . $image->extension();
            //store the image in the public folder
            $path = $image->storeAs('images', $imageName, 'public');
            $savedImages[] = [
                'name' => $imageName,
                'path' => $path,
            ];
        }

        $this->projectModel->find($request->project_id)->images()->createMany($savedImages);


        // Opcional: Guardar información en la base de datos, etc.
        // ...

        return response()->json(['success' => true, 'savedImages' => $savedImages]);
    }
}
