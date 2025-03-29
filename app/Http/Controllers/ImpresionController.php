<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpresionController extends Controller
{
    public function calcularPrecio(Request $request)
    {
        $precios = [
            'bn' => [
                '1' => ['bond' => 400, 'opalina' => 2500, 'fotografico' => 3500, 'adhesivo' => 2500],
                '2' => ['bond' => 600, 'opalina' => 3500, 'fotografico' => 3500, 'adhesivo' => 2500]
            ],
            'color' => [
                '1' => ['bond' => 2000, 'opalina' => 3500, 'fotografico' => 3500, 'adhesivo' => 2500],
                '2' => ['bond' => 3000, 'opalina' => 3500, 'fotografico' => 3500, 'adhesivo' => 2500]
            ]
        ];

        $color = $request->input('color');
        $caras = $request->input('caras');
        $papel = $request->input('papel');
        $cantidad = (int) $request->input('cantidad');
        $copias = (int) $request->input('copias');

        // Verificamos si los datos existen en la estructura de precios
        if (!isset($precios[$color][$caras][$papel])) {
            return response()->json(['error' => 'Datos inválidos'], 400);
        }

        $precio_unitario = $precios[$color][$caras][$papel];
        $subtotal = $precio_unitario * $cantidad * $copias;

        // Definir costo de envío
        $envio = 0;

        // Calcular total
        $total = $subtotal + $envio;

        return response()->json([
            'subtotal' => $subtotal,
            'envio' => $envio,
            'total' => $total
        ]);
    }
}

