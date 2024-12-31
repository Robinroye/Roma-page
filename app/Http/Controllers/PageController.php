<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
