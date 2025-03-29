<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Asegurarse de que el nombre coincida con la base de datos

    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'imagenes',
        'stock'
    ];

    protected $casts = [
        'imagenes' => 'array' // Para manejar múltiples imágenes en formato JSON
    ];
}