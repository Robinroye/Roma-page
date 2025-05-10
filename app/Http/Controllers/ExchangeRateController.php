<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'tasa' => 'required|numeric'
        ]);

        $rate = ExchangeRate::latest()->first();
        $rate->update([
            'tasa' => $request->tasa
        ]);

        return redirect()->route('admin')->with('success', 'Tasa actualizada correctamente.');
    }
}
