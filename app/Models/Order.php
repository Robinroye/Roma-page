<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

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
