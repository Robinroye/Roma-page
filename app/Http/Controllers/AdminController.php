<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $productos = Product::all();
        return view('admin', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
            'imagenes' => 'required',
            'stock' => 'required|numeric'
        ]);

        Product::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagenes' => json_encode($request->imagenes), // Guardar imágenes en formato JSON
            'stock' => $request->stock
        ]);

        return redirect()->back()->with('success', 'Producto agregado con éxito.');
    }
}
