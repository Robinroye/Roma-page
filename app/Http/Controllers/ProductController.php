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
            'imagenes' => $imagenesPaths, // Guardamos como array, Eloquent lo convierte a JSON
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin')->with('success', 'Producto guardado correctamente.');
    }
    public function update(Request $request, $id)
    {
        $producto = Product::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Actualizar campos
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;

        if ($request->hasFile('imagenes')) {
            $imagenesPaths = [];
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('images', 'public');
                $imagenesPaths[] = $path;
            }
            $producto->imagenes = $imagenesPaths; // Guardamos como array
        }

        $producto->save();

        return redirect()->route('admin')->with('success', 'Producto actualizado correctamente.');
    }
    public function destroy($id)
    {
    $producto = Product::findOrFail($id);

    // Elimina imágenes del storage (opcional pero recomendado)
    if ($producto->imagenes) {
        foreach ((array)$producto->imagenes as $imagen) { // $producto->imagenes ya es array
            \Storage::disk('public')->delete($imagen);
        }
    }

    $producto->delete();

    return redirect()->route('admin')->with('success', 'Producto eliminado correctamente.');
    }

}
