<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Giro;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_phone' => 'required|string',
            'tipo' => 'required|string',
            'total' => 'required|numeric',
            'detalles' => 'required|array',
        ]);

        $detalles = $request->detalles;
        $orderDetalles = [];
        $giroDetalles = [];

        foreach ($detalles as $detalle) {
            if (isset($detalle['tipo']) && $detalle['tipo'] === 'impresion' && isset($detalle['impresion_archivos'])) {
                $file = $detalle['impresion_archivos'];
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $filePath = $file->store('public');
                    $detalle['impresion_archivos'] = asset(str_replace('public', 'storage', $filePath));
                }
            }
            if (isset($detalle['tipo']) && $detalle['tipo'] === 'giro') {
                $giroDetalles[] = $detalle;
            } else {
                $orderDetalles[] = $detalle;
            }
        }

        if (!empty($orderDetalles)) {
            $order = Order::create([
                'user_phone' => $request->user_phone,
                'tipo' => $request->tipo,
                'total' => $request->total,
                'detalles' => $orderDetalles,
                'estado' => 'pendiente',
            ]);
        }
        // Create a single Giro entry if there are any giro detalles
        if (!empty($giroDetalles)) {
            Giro::create([
                'user_phone' => $request->user_phone,
                'tipo' => $request->tipo,
                'total' => $request->total,
                'detalles' => $giroDetalles,
                'estado' => 'pendiente',
            ]);
        }

        return response()->json([
            'success' => true,
            'order_id' => $order->id
        ]);
    }

    public function index()
    {
        $orders = Order::all();
        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $request->validate([
            'user_phone' => 'string',
            'tipo' => 'string',
            'total' => 'numeric',
            'detalles' => 'array',
            'estado' => 'string',
        ]);

        $order->update($request->all());

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $detalles = $order->detalles;

        if (is_array($detalles)) {
            foreach ($detalles as $detalle) {
                if (isset($detalle['tipo']) && $detalle['tipo'] === 'impresion' && isset($detalle['impresion_archivos'])) {
                    $fileUrl = $detalle['impresion_archivos'];
                    $relativePath = str_replace('/uploads', 'uploads', parse_url($fileUrl, PHP_URL_PATH)); // Adjust path
                    $filePath = storage_path("app/public/{$relativePath}"); // Directly reference storage path
                    if (file_exists($filePath)) {
                        unlink($filePath); // Delete the file using PHP's unlink
                    }
                }
            }
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
    }
}

