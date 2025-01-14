<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/giros', [PageController::class, 'giros'])->name('giros');
Route::get('/variedades', [PageController::class, 'variedades'])->name('variedades');
Route::get('/impresion', [PageController::class, 'impresion'])->name('impresion');
Route::get('/plotter', [PageController::class, 'plotter'])->name('plotter');
Route::get('/carrito', [PageController::class, 'carrito'])->name('carrito');
Route::get('/ayuda', [PageController::class, 'ayuda'])->name('ayuda');
Route::get('/sin-cuentas', [PageController::class, 'sinCuentas'])->name('sin-cuentas');
Route::post('/guardar-cuenta', [PageController::class, 'guardarCuenta'])->name('guardar-cuenta');
Route::get('/cuentas', [PageController::class, 'cuentas'])->name('cuentas');