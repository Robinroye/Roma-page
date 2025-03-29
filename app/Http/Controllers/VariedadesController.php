<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class VariedadesController extends Controller
{
    public function index()
    {
        // Obtener productos desde la base de datos
        $productos = Product::all(); 

        return view('variedades', compact('productos'));
    }

    public function show($id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }
}
