<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    // Guardar o actualizar una cuenta
    public function guardarCuenta(Request $request, $id = null)
    {
        $validated = $request->validate($this->validationRules(), $this->validationMessages());

        if ($id) {
            $cuenta = $this->findCuenta($id);
            $cuenta->update($validated);

            $message = '¡Cuenta actualizada exitosamente!';
        } else {
            Cuenta::create($validated);
            $message = '¡Cuenta guardada exitosamente!';
        }

        return redirect()->route('cuentas', ['numero_whatsapp' => $request->numero_whatsapp])
            ->with('success', $message);
    }
    
    // Mostrar formulario para agregar cuenta
    public function agregarCuenta(Request $request)
    {
        $numeroWhatsapp = $request->input('numero_whatsapp');
        return view('cuentas.agregar', compact('numeroWhatsapp'));
    }

    // Mostrar formulario para editar cuenta
    public function editarCuenta($id)
    {
        $cuenta = $this->findCuenta($id);
        return view('cuentas.editar', compact('cuenta'));
    }

    // Listar cuentas según número de WhatsApp
    public function cuentas(Request $request)
    {
        $numeroWhatsapp = $request->input('numero_whatsapp');
        $cuentas = $numeroWhatsapp
            ? Cuenta::where('numero_whatsapp', $numeroWhatsapp)->get()
            : Cuenta::all();

        if ($numeroWhatsapp && $cuentas->isEmpty()) {
            return redirect()->route('sin-cuentas')->with('numero_whatsapp', $numeroWhatsapp);
        }

        return view('cuentas', compact('cuentas', 'numeroWhatsapp'));
    }

    // Verificar número de WhatsApp
    public function verificarNumero(Request $request)
    {
        $validated = $request->validate([
            'numero_whatsapp' => 'required|string|max:20',
        ]);

        $cuentas = Cuenta::where('numero_whatsapp', $validated['numero_whatsapp'])->get();

        return $cuentas->isNotEmpty()
            ? redirect()->route('cuentas', ['numero_whatsapp' => $validated['numero_whatsapp']])
            : redirect()->route('sin-cuentas')->with('numero_whatsapp', $validated['numero_whatsapp']);
    }

    // Reglas de validación comunes
    private function validationRules()
    {
        return [
            'nombre_titular' => 'required|string|max:255',
            'tipo_documento' => 'required|string',
            'numero_documento' => 'required|numeric',
            'numero_cuenta' => 'required|numeric',
            'pago_movil' => 'required|string|max:20',
            'numero_whatsapp' => 'required|string|max:20',
        ];
    }

    // Mensajes de validación personalizados
    private function validationMessages()
    {
        return [
            'nombre_titular.required' => 'El nombre del titular es obligatorio.',
            'numero_cuenta.required' => 'El número de cuenta es obligatorio.',
            'numero_whatsapp.required' => 'El número de WhatsApp es obligatorio.',
        ];
    }

    // Buscar cuenta o lanzar error si no existe
    private function findCuenta($id)
    {
        $cuenta = Cuenta::find($id);

        if (!$cuenta) {
            abort(404, 'La cuenta especificada no existe.');
        }

        return $cuenta;
    }
}
