<?php

namespace App\Http\Controllers;

use App\Models\Giro;
use App\Models\Order;
use Illuminate\Http\Request;

class WompiController extends Controller
{
    public function webhook(Request $request)
{
    $event = $request->input('event');
    $data = $request->input('data');

    if ($event === 'transaction.updated') {
        $status = $data['transaction']['status'];
        $reference = $data['transaction']['reference'];

        if ($status === 'APPROVED') {
            $sessionKey = 'pedido_' . $reference;

            if (session()->has($sessionKey)) {
                $pedido = session($sessionKey);

                $detalles = $pedido['detalles'];
                $orderDetalles = [];
                $giroDetalles = [];

                foreach ($detalles as $detalle) {
                    if (isset($detalle['tipo']) && $detalle['tipo'] === 'giro') {
                        $giroDetalles[] = $detalle;
                    } else {
                        $orderDetalles[] = $detalle;
                    }
                }

                if (!empty($orderDetalles)) {
                    Order::create([
                        'user_phone' => $pedido['user_phone'],
                        'tipo' => $pedido['tipo'],
                        'total' => $pedido['total'],
                        'detalles' => $orderDetalles,
                        'estado' => 'pagado',
                    ]);
                }

                if (!empty($giroDetalles)) {
                    Giro::create([
                        'user_phone' => $pedido['user_phone'],
                        'tipo' => $pedido['tipo'],
                        'total' => $pedido['total'],
                        'detalles' => $giroDetalles,
                        'estado' => 'pagado',
                    ]);
                }

                session()->forget($sessionKey);
            }
        }
    }

    return response()->json(['status' => 'ok']);
}

}
