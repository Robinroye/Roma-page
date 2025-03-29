<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación de imágenes
        ]);

        $imagenesPaths = [];

        // Verifica si se subieron imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                // Guarda la imagen en public/images y almacena la ruta
                $path = $imagen->store('images', 'public');
                $imagenesPaths[] = $path;
            }
        }

        // Guarda en la base de datos
        Product::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagenes' => json_encode($imagenesPaths), // Guardamos en formato JSON
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin')->with('success', 'Producto guardado correctamente.');
    }
}
