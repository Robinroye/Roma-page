<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta; // Importa el modelo Cuenta

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

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
        return view('impresion');
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
        return view('admin');
    }
}
