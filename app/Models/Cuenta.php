<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_titular',
        'tipo_documento',
        'numero_documento',
        'numero_cuenta',
        'pago_movil',
    ];
}
