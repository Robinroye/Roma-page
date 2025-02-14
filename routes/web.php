<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\VariedadesController;
use App\Http\Controllers\ImpresionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/giros', [PageController::class, 'giros'])->name('giros');
Route::get('/variedades', [PageController::class, 'variedades'])->name('variedades');
Route::get('/impresion', [PageController::class, 'impresion'])->name('impresion');
Route::get('/plotter', [PageController::class, 'plotter'])->name('plotter');
Route::get('/carrito', [PageController::class, 'carrito'])->name('carrito');
Route::get('/ayuda', [PageController::class, 'ayuda'])->name('ayuda');
Route::get('/sin-cuentas', [PageController::class, 'sinCuentas'])->name('sin-cuentas');
Route::post('/guardar-cuenta', [CuentaController::class, 'guardarCuenta'])->name('guardar-cuenta');
Route::get('/cuentas', [CuentaController::class, 'cuentas'])->name('cuentas');
Route::post('/verificar-numero', [CuentaController::class, 'verificarNumero'])->name('verificar-numero');
Route::get('/cuentas/agregar', [CuentaController::class, 'agregarCuenta'])->name('agregar-cuenta');
Route::post('/cuentas/agregar', [CuentaController::class, 'guardarNuevaCuenta'])->name('guardar-nueva-cuenta');
Route::get('/cuentas/editar/{id}', [CuentaController::class, 'editarCuenta'])->name('editar-cuenta');
Route::put('/cuentas/editar/{id}', [CuentaController::class, 'guardarCuenta'])->name('actualizar-cuenta');
Route::get('/variedades', [VariedadesController::class, 'index'])->name('variedades');
Route::get('/producto/{id}', [VariedadesController::class, 'show'])->name('detalle.producto');
Route::get('/variedades/producto/{id}', [VariedadesController::class, 'show'])->name('variedades.show');
Route::post('/calcular-precio', [ImpresionController::class, 'calcularPrecio']);