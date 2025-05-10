<?php

namespace App\Http\Controllers;

use App\Models\PrintOption;
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
    public function storeTipoImpresion(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'color' => 'required|in:bn,color',
            'precio' => 'required|numeric',
        ]);

        PrintOption::create([
            'tipo_papel' => $request->nombre,
            'precio' => $request->precio,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('success', 'Tipo de impresion agregado con éxito.');
    }
    public function updateTipoImpresion(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:print_options,id',
            'nombre' => 'required',
            'color' => 'required|in:bn,color',
            'precio' => 'required|numeric',
        ]);

        $tipoImpresion = PrintOption::find($request->id);
        $tipoImpresion->tipo_papel = $request->nombre;
        $tipoImpresion->color = $request->color;
        $tipoImpresion->precio = $request->precio;
        $tipoImpresion->save();

        return redirect()->back()->with('success', 'Tipo de impresion actualizado con éxito.');
    }
}
