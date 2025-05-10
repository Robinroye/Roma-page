<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PrintOption;

class PrintOptionController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $printOptions = PrintOption::all();
        return response()->json($printOptions);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        Log::info('Store PrintOption Request Data:', $request->all());
        $request->validate([
            'tipo_papel' => 'required',
            'color' => 'required|in:bn,color',
            'precio' => 'required|numeric',
        ]);

        // Log the incoming request data for debugging

        try {
            $printOption = PrintOption::create($request->all());
            Log::info('PrintOption Created Successfully:', $printOption->toArray());
            return redirect()->back()->with('success', 'Tipo de impresion agregado con éxito.');
        } catch (\Exception $e) {
            // Log any errors during the creation process
            Log::error('Error Creating PrintOption:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Error al agregar el tipo de impresión.');
        }
    }

    // Display the specified resource
    public function show($id)
    {
        $printOption = PrintOption::findOrFail($id);
        return response()->json($printOption);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_papel' => 'required',
            'color' => 'required|in:bn,color',
            'precio' => 'required|numeric',
        ]);

        $printOption = PrintOption::findOrFail($id);
        $printOption->update($request->only(['tipo_papel', 'color', 'precio']));
        return redirect()->back()->with('success', 'Tipo de impresion actualizado con éxito.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $printOption = PrintOption::findOrFail($id);
        $printOption->delete();
        return redirect()->back()->with('success', 'Tipo de impresion eliminado con éxito.');

    }
}
