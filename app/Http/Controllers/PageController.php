<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cuenta; // Importa el modelo Cuenta
use App\Models\PrintOption;

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
