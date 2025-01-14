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

    public function guardarCuenta(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_titular' => 'required|string|max:255',
            'tipo_documento' => 'required|string',
            'numero_documento' => 'required|numeric',
            'numero_cuenta' => 'required|numeric',
            'pago_movil' => 'required|string|max:20',
        ]);

        // Procesar los datos o guardarlos en la base de datos (pendiente)
        // Aquí puedes usar un modelo para guardar los datos
        Cuenta::create($request->all());

        // Retornar una respuesta
        return redirect()->route('cuentas')->with('success', '¡La cuenta ha sido guardada exitosamente!');
    }
    public function cuentas()
    {
        // Obtener todas las cuentas de la base de datos
        $cuentas = Cuenta::all();

        // Pasar las cuentas a la vista
        return view('cuentas', compact('cuentas'));
    }
}
