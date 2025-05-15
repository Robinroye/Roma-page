<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giro;

class GiroController extends Controller
{
    

    public function index()
    {
        $orders = Giro::all();
        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = Giro::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Giro not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Giro::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Giro not found'
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
        $order = Giro::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Giro not found'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Giro deleted successfully'
        ]);
    }
}

