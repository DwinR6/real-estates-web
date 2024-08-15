<?php

namespace App\Http\Controllers;

use App\Models\ServiceModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceModel;

    public function __construct(ServiceModel $serviceModel)
    {
        $this->serviceModel = $serviceModel;
    }

    public function index()
    {
        $services = $this->serviceModel->all()->load('images');

        return response()->json($services);
    }



    public function store(Request $request)
    {


        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $service = $this->serviceModel->create($request->all());

            return response()->json($service);
        } catch (\Throwable $th) {
            //throw $th;
            throw new \Exception($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {


        try {

            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $service = $this->serviceModel->find($id);

            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }

            $service->update($request->all());

            return response()->json($service);
        } catch (\Throwable $th) {
            //throw $th;
            throw new \Exception($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $service = $this->serviceModel->find($id);

            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }

            $service->delete();

            return response()->json(['message' => 'Service deleted']);
        } catch (\Throwable $th) {
            //throw $th;
            throw new \Exception($th->getMessage());
        }
    }

    public function storeImages(Request $request, $id)
    {

        try {

            $request->validate([
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $service = $this->serviceModel->find($id);

            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }

            $storedImages = [];

            foreach ($request->file('images') as $image) {
                $name = $id . '_' . time() . '.' . $image->extension();
                $path = $image->storeAs('services', $name, 'public');
                $storedImages[] = [
                    'name' => $name,
                    'path' => $path
                ];
            }

            $service->images()->createMany($storedImages);



            return response()->json($image);
        } catch (\Throwable $th) {
            //throw $th;
            throw new \Exception($th->getMessage());
        }
    }
}
