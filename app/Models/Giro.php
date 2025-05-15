<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Giro extends Model
{
    protected $table = 'giros';

    protected $fillable = [
        'user_phone',
        'tipo',
        'total',
        'estado',
        'detalles'
    ];

    protected $casts = [
        'detalles' => 'array'
    ];
}
