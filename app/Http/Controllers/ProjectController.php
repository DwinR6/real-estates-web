<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{

    protected $projectModel;

    public function __construct(ProjectModel $projectModel)
    {
        $this->projectModel = $projectModel;
    }


    public function index()
    {
        $projects = $this->projectModel->with([
            'developer' => function ($query) {
                $query->select('developer_id', 'name')->with([
                    'phones' => function ($query) {
                        $query->select('phone_id', 'phone_number');
                    },
                    'emails' => function ($query) {}
                ]);
            },
            'category' => function ($query) {
                $query->select('category_id', 'name');
            },
            'images' => function ($query) {
                //get first image
                $query->select('imageable_id', 'name', 'path')->where('imageable_type', 'App\Models\ProjectModel')->limit(1);
            },

        ])->get();
        return Inertia::render('Projects', [
            'projects' => $projects
        ]);
    }

    public function show($id)
    {
        $projects = [
            [
                'id' => 1,
                'name' => 'Lotificacion El Papalon Poniente',
                'description' => 'Lotificacion El Papalon Poniente, es un proyecto de lotificacion de terrenos, que ofrece la opción de comprar su LOTE y le construimos su vivienda innovadora a precios accesibles. LOTIFICACION EL PAPALON PONIENTE, es totalmente privada y está ubicada a un minuto del desvió agua caliente salida a la carretera Ruta militar, salida a San Salvado y San Migue, y la Unión y se encuentra a cinco minutos de la Ciudad de Santa Rosa de Lima, esta Ciudad cuenta con un Hospital Nacional, Centros comerciales y Mercado Municipal, Gasolineras Puma, y Restaurante la Pema, todos accesibles a la Lotificación.',

                'lot_description' => 'Los Lotes disponibles cuentan son de 200 metros cuadros; con las siguientes medidas de 10 Metros de Ancho, por 20 Metros de Largo, la LOTIFICACION EL PAPALON PONIENTE, es un de Proyecto de DGD URBANO, que ofrece la opción de comprar su LOTE y le construimos su vivienda innovadora aprecios Accesibles". LOTIFICACION EL PAPALON PONIENTE, es totalmente privada y está ubicada a un minuto del desvió agua caliente salida a la carretera Ruta militar, salida a San Salvado y San Migue, y la Unión y se encuentra a cinco minutos de la Ciudad de Santa Rosa de Lima, esta Ciudad cuenta con un Hospital Nacional, Centros comerciales y Mercado Municipal, Gasolineras Puma, y Restaurante la Pema, todos accesibles a la Lotificación. ',
                'infrastructure_description' => [
                    'Agua Potable',
                    'Energia Electrica en todas las vias',
                    'Tratamiento de aguas lluvias, mediante cordones de cuneta, badenes, canaletas y canaletas con parrilla',
                    'Vías de Circulación, con concreto o asfalto. (sujeto a modificaciones)',
                    'Aceras con concreto simple.',
                    'Cordón- Cuneta, con concreto Ciclópeo Revestido.',
                    'Obras de protección, Muro perimetral y Taludes.',
                    'Tendrá Muro perimetral en todo el perímetro de la urbanización.'
                ],
                'area_descriptions' => [
                    'Amplias zonas de área verde ecológica y recreativa.',
                    'Área de equipamiento social.',
                    'Área de circulación Redondel.'
                ],
                'location' => 'Santa Rosa de Lima, La Union',
                'status' => 'En construccion',
                'category' => 'Urbanizacion',
                'start_date' => '2021-01-01',
                'end_date' => '2022-01-01',
                'coordinates' => [
                    'latitude' => 13.4847,
                    'longitude' => -88.1776
                ],

                'developer' => [
                    'name' => 'DGD Urbano',
                    'description' => 'Las empresas salvadoreñas que inicia operaciones en el ano 2021, a través del desarrollo de Lotificaciones planificadas que, ofrecen a sus residentes lotes de terrenos con un enfoque de Privacidad, Seguridad y Recreación.',
                    'address' => 'Calle El Tizate, Canton los Reyes, Anamoros, la Union.',
                    'managers' => [
                        'Juan Ubaldo Cruz Reyes',
                        'Tania Vanessa Cruz de Reyes'
                    ],
                    'phones' => [
                        '7545-0689  ',
                        '2222-2222'
                    ],
                ],
                'images' => [
                    [
                        'src' => 'https://via.placeholder.com/400x300',
                        'alt' => 'Imagen 1'
                    ],
                    [
                        'src' => 'https://via.placeholder.com/800x600',
                        'alt' => 'Imagen 2'
                    ],
                    [
                        'src' => 'https://via.placeholder.com/800x600',
                        'alt' => 'Imagen 3'
                    ],
                    [
                        'src' => 'https://via.placeholder.com/800x600',
                        'alt' => 'Imagen 4'
                    ]
                ],
                'videos' => [
                    [
                        'src' => 'https://www.youtube.com/embed/1a2b3c4d5e',
                        'alt' => 'Video 1'
                    ],
                    [
                        'src' => 'https://www.youtube.com/embed/1a2b3c4d5e',
                        'alt' => 'Video 2'
                    ]
                ],


            ],
            [
                'id' => 2,
                'name' => 'Urbanizacion La Cima de Nueva Guadalupe',
                'description' => 'Urbanización la Cima de Guadalupe PRIMERA ETAPA I, es un proyecto de lotificación de terrenos, que ofrece la opción de comprar su LOTE y le construimos su vivienda innovadora a precios accesibles. Urbanización la Cima de Guadalupe, es totalmente privada y está ubicada a un minuto desvió de la carretera panamericana salida a San Salvado y San Miguel y está a un minuto de la Ciudad de Nueva Guadalupe, y cuenta con un Hospital Nacional, casas comerciales y Mercado Municipal, Gasolineras y a sólo quince minutos del centro comercial.',
                'lot_description' => 'Los Lotes disponibles cuentan son de 200 metros cuadros; con las siguientes medidas de 10 Metros de Ancho, por 20 Metros de Largo, la Urbanización la Cima de Guadalupe PRIMERA ETAPA I, es un de Proyecto de Desarrolladora JC S.A de C.V, que ofrece la opción de comprar su LOTE y le construimos su vivienda innovadora aprecios Accesibles". Urbanización la Cima de Guadalupe, es totalmente privada y está ubicada a un minuto desvió de la carretera panamericana salida a San Salvado y San Miguel y está a un minuto de la Ciudad de Nueva Guadalupe, y cuenta con un Hospital Nacional, casas comerciales y Mercado Municipal, Gasolineras y a sólo quince minutos del centro comercial Pric Smart de la Ciudad de San Miguel.',
                'infrastructure_descriptions' => [
                    'Agua Potable',
                    'Energia Electrica en todas las vias',
                    'Tratamiento de aguas lluvias, mediante cordones de cuneta, badenes, canaletas y canaletas con parrilla',
                    'Vías de Circulación, con concreto o asfalto. (sujeto a modificaciones)',
                    'Aceras con concreto simple.',
                    'Cordón Cuneta, con concreto Ciclópeo Revestido.',
                    'Obras de protección, Muro perimetral y Taludes.',
                    'Tendrá Muro perimetral en todo el perímetro de la urbanización.'
                ],
                'area_descriptions' => [
                    'Amplias zonas de área verde ecológica y recreativa.',
                    'Área de equipamiento social.',
                    'Área de circulación Redondel.'
                ],
                'location' => 'Santa Rosa de Lima, La Union',
                'status' => 'En construccion',
                'category' => 'Urabnizacion',
                'start_date' => '2021-01-01',
                'end_date' => '2022-01-01',
                'coordinates' => [
                    'latitude' => 13.4847,
                    'longitude' => -88.1776
                ],

                'developer' => [
                    'name' => 'Desarrolladora JC S.A de C.V',
                    'description' => 'Es una empresa salvadoreña que inicia operaciones en el ano 2021, a través del desarrollo de Lotificaciones planificadas que, ofrecen a sus residentes lotes de terrenos con un enfoque de Privacidad, Seguridad y Recreación',
                    'address' => 'Calle El Tizate, Canton los Reyes, Anamoros, la Union.',
                    'managers' => [
                        'Juan Ubaldo Cruz Reyes',
                        'Tania Vanessa Cruz de Reyes'
                    ],
                    'phones' => [
                        '7545-0689',
                        '(702) 572 - 6843'
                    ],
                ],
                'images' => [
                    [
                        'src' => '../../../lacima.jpg',
                        'alt' => 'Imagen 1'
                    ],
                    [
                        'src' => 'https://via.placeholder.com/800x600',
                        'alt' => 'Imagen 2'
                    ],
                    [
                        'src' => 'https://via.placeholder.com/800x600',
                        'alt' => 'Imagen 3'
                    ],
                    [
                        'src' => 'https://via.placeholder.com/800x600',
                        'alt' => 'Imagen 4'
                    ]
                ],
                'videos' => [
                    [
                        'src' => 'https://www.youtube.com/embed/1a2b3c4d5e',
                        'alt' => 'Video 1'
                    ],
                    [
                        'src' => 'https://www.youtube.com/embed/1a2b3c4d5e',
                        'alt' => 'Video 2'
                    ]
                ],


            ]
        ];

        $project = $this->projectModel->with([
            'developer' => function ($query) {
                $query->with([
                    'phones',
                    'emails',
                    'managers'
                ]);
            },
            'category' => function ($query) {
                $query->select('category_id', 'name');
            },
            'images',

        ])->find($id);
        return Inertia::render('Projects/Project', [
            'project' => $project
        ]);
    }

    public function create()
    {
        return Inertia::render('Projects/Form');
    }

    public function store(Request $request)
    {


        // Validate the request...
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required',
                'lot_description' => 'required',
                'infrastructure_description' => 'required',
                'area_description' => 'required',
                'location' => 'required',
                'status' => 'required',
                'category' => 'required',
                'start_date' => 'required',
                'coordinates' => 'required',
                'developer' => 'required',
            ],
            [
                'name.required' => 'El nombre es requerido',
                'description.required' => 'La descripcion es requerida',
                'lot_description.required' => 'La descripcion del lote es requerida',
                'infrastructure_description.required' => 'La descripcion de la infraestructura es requerida',
                'area_description.required' => 'La descripcion del area es requerida',
                'location.required' => 'La ubicacion es requerida',
                'status.required' => 'El estado es requerido',
                'category.required' => 'La categoria es requerida',
                'start_date.required' => 'La fecha de inicio es requerida',
                'coordinates.required' => 'Las coordenadas son requeridas',
                'developer.required' => 'El desarrollador es requerido',
            ]
        );

        //rename key developer to developer_id
        $validated['developer_id'] = $validated['developer'];
        unset($validated['developer']);
        $validated['category_id'] = $validated['category'];
        unset($validated['category']);



        $project = $this->projectModel->create($validated);

        return response()->json($project);
    }

    public function edit($id)
    {
        $project = $this->projectModel->with([
            'developer' => function ($query) {
                $query->select('developer_id', 'name')->with([
                    'phones',
                    'emails'
                ]);
            },
            'category' => function ($query) {
                $query->select('category_id', 'name');
            },
            'images',

        ])->find($id);
        return Inertia::render('Projects/Form', [
            'project' => $project
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request...
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required',
                'lot_description' => 'required',
                'infrastructure_description' => 'required',
                'area_description' => 'required',
                'location' => 'required',
                'status' => 'required',
                'category' => 'required',
                'start_date' => 'required',
                'coordinates' => 'required',
                'developer' => 'required',
            ],
            [
                'name.required' => 'El nombre es requerido',
                'description.required' => 'La descripcion es requerida',
                'lot_description.required' => 'La descripcion del lote es requerida',
                'infrastructure_description.required' => 'La descripcion de la infraestructura es requerida',
                'area_description.required' => 'La descripcion del area es requerida',
                'location.required' => 'La ubicacion es requerida',
                'status.required' => 'El estado es requerido',
                'category.required' => 'La categoria es requerida',
                'start_date.required' => 'La fecha de inicio es requerida',
                'coordinates.required' => 'Las coordenadas son requeridas',
                'developer.required' => 'El desarrollador es requerido',
            ]
        );

        //rename key developer to developer_id
        $validated['developer_id'] = $validated['developer'];
        unset($validated['developer']);
        $validated['category_id'] = $validated['category'];
        unset($validated['category']);

        $project = $this->projectModel->find($id);
        $project->update($validated);

        //inertia response muted for now

        return response()->json($project);
    }

    public function destroy($id)
    {
        $project = $this->projectModel->find($id);
        $project->delete();
        return response()->json($project);
    }

    public function storeImages(Request $request, $id)
    {
        $project = $this->projectModel->find($id);
        $images = $request->file('images');

        $storgeImages = [];
        foreach ($images as $image) {
            $name = $id . '_' . time() . '.' . $image->extension();
            $path = $image->storeAs('projects', $name, 'public');
            $storgeImages[] = [
                'name' => $name,
                'path' => $path,
            ];
        }

        $project->images()->createMany($storgeImages);
        return response()->json([
            'success' => true,
            'project_id' => $project->project_id,
        ]);
    }
}
