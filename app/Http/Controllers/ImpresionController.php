<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrintOption;

class ImpresionController extends Controller
{
    // Método para calcular precio desde el frontend dinámicamente
    public function calcularPrecio(Request $request)
    {
        $color = $request->input('color');     // 'bn' o 'color'
        $caras = $request->input('caras');     // '1' o '2'
        $papel = $request->input('papel');     // 'bond', 'opalina', etc.
        $cantidad = (int) $request->input('cantidad'); // páginas a imprimir
        $copias = (int) $request->input('copias');     // número de copias

        // Buscar el precio unitario en la base de datos
        $opcion = PrintOption::where('tipo_papel', $papel)
            ->where('color', $color)
            ->first();

        if (!$opcion) {
            return response()->json(['error' => 'Datos inválidos. No se encontró precio.'], 400);
        }

        // Si es a doble cara, puedes aplicar un ajuste (opcional)
        $multiplicador = $caras == '2' ? 1.5 : 1;

        $precio_unitario = intval($opcion->precio * $multiplicador);

        $subtotal = $precio_unitario * $cantidad * $copias;

        // Aquí puedes definir reglas de envío si las necesitas
        $envio = 0;

        $total = $subtotal + $envio;

        return response()->json([
            'subtotal' => $subtotal,
            'envio' => $envio,
            'total' => $total
        ]);
    }

    // ✅ Método nuevo para devolver todos los precios al frontend
    public function precios()
    {
        $printOptions = PrintOption::all();
        return response()->json($printOptions);
    }
}
