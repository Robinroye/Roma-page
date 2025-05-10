<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintOption extends Model
{
    protected $table = 'print_options';
    
    protected $fillable = ['tipo_papel', 'color', 'precio'];
}
