<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cuenta; // Importa el modelo Cuenta
use App\Models\PrintOption;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function giros()
    {
        return view('giros');
    }

    public function variedades()
    {
        return view('variedades');
    }

    public function impresion()
    {
        $tiposPapel = PrintOption::pluck('tipo_papel')->unique();
        return view('impresion')->with('tiposPapel', $tiposPapel);
    }

    public function plotter()
    {
        return view('plotter');
    }

    public function carrito()
    {
        return view('carrito');
    }
    public function generarPago(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:1'
            // 'phone' => 'string|nullable' // Puedes validar si lo deseas
        ]);
    
        $amountInCents = $request->amount;
        $currency = 'COP';
        $reference = 'PEDIDO_' . Str::random(10);
        $integritySecret = env('WOMPI_INTEGRITY_SECRET');
    
        $firma = hash('sha256', $reference . $amountInCents . $currency . $integritySecret);
    
        return response()->json([
            'reference' => $reference,
            'amountInCents' => $amountInCents,
            'currency' => $currency,
            'firma' => $firma,
            'publicKey' => env('WOMPI_PUBLIC_KEY'),
            'phone' => $request->phone // <-- add this line
        ]);
    }
    public function ayuda()
    {
        return view('ayuda');
    }
    public function sinCuentas()
    {
        return view('sin-cuentas');
    }
    public function admin()
    {
        $productos = \App\Models\Product::all();
        $tiposDeImpresion = \App\Models\PrintOption::all();
        $tasa = \App\Models\ExchangeRate::latest()->first();
        return view('admin', compact('productos', 'tasa', 'tiposDeImpresion'));
    }
    public function home()
    {
        return view('home');
    }

    public function cuentas()
    {
        return view('cuentas');
    }
}
