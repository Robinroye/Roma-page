<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariedadesController extends Controller
{
    public function index()
    {
        // Datos ficticios para los productos
        $productos = [
            [
                'id' => 1,
                'nombre' => 'Anillos Cover Gold',
                'precio' => 10000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            [
                'id' => 2,
                'nombre' => 'Producto 2',
                'precio' => 30000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            [
                'id' => 3,
                'nombre' => 'Producto 2',
                'precio' => 30000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            [
                'id' => 4,
                'nombre' => 'Producto 2',
                'precio' => 30000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            [
                'id' => 5,
                'nombre' => 'Producto 2',
                'precio' => 30000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            [
                'id' => 6,
                'nombre' => 'Producto 2',
                'precio' => 30000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            [
                'id' => 7,
                'nombre' => 'Producto 2',
                'precio' => 30000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            [
                'id' => 8,
                'nombre' => 'Producto 2',
                'precio' => 30000,
                'imagenes' => [
                    '/images/variedades/item1-1.svg',
                    '/images/variedades/item1-2.svg',
                    '/images/variedades/item1-3.svg'
                ]
            ],
            // Más productos si los necesitas
        ];

        // Pasamos la colección de productos a la vista
        return view('variedades', compact('productos'));
    }

    public function show($id)
{
    $productos = [
        1 => [
            'id'=> 1,
            'nombre' => 'Anillos Cover Gold',
            'precio' => 10000,
            'descripcion' => 'Descripción detallada del Producto 1',
            'imagenes' => [
                '/images/variedades/item1-1.svg',
                '/images/variedades/item1-2.svg',
                '/images/variedades/item1-3.svg'
                ]
            ],
        2 => [
            'id'=> 2,
            'nombre' => 'Producto 2',
            'precio' => 30000,
            'descripcion' => 'Descripción detallada del Producto 2',
            'imagenes' => [
                '/images/variedades/item1-1.svg',
                '/images/variedades/item1-2.svg',
                '/images/variedades/item1-3.svg'
            ]
        ],
    ];

     // Verifica que el producto exista
     if (!isset($productos[$id])) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    // Si es una solicitud AJAX, devuelve JSON
        return response()->json($productos[$id]);

}

}
