<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\VariedadesController;
use App\Http\Controllers\ImpresionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\PrintOptionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\WompiController;
use App\Http\Controllers\GiroController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/giros', [PageController::class, 'giros'])->name('giros');
Route::get('/variedades', [PageController::class, 'variedades'])->name('variedades');
Route::get('/impresion', [PageController::class, 'impresion'])->name('impresion');
Route::get('/plotter', [PageController::class, 'plotter'])->name('plotter');
Route::get('/carrito', [PageController::class, 'carrito'])->name('carrito');
Route::post('/carrito/pago', [PageController::class, 'generarPago']);
Route::post('/wompi/webhook', [WompiController::class, 'webhook']);
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
Route::post('/admin/store', [ProductController::class, 'store'])->name('admin.store');
Route::get('/admin', [PageController::class, 'admin'])->name('admin');
Route::put('/admin/tasa', [ExchangeRateController::class, 'update'])->name('exchange-rate.update');
Route::get('/precios-impresion', [ImpresionController::class, 'precios']);
Route::post('/admin/storeTipoImpresion', [PrintOptionController::class, 'store'])->name('admin.storeTipoImpresion');
Route::patch('/admin/updateTipoImpresion/{id}', [PrintOptionController::class, 'update'])->name('admin.updateTipoImpresion');
Route::delete('/admin/deleteTipoImpresion/{id}', [PrintOptionController::class, 'destroy'])->name('admin.deleteTipoImpresion');
Route::get('/admin', [PageController::class, 'admin'])->name('admin');
Route::delete('/admin/productos/{id}', [ProductController::class, 'destroy'])->name('productos.destroy');
Route::put('/productos/{id}', [ProductController::class, 'update'])->name('productos.update');
Route::post('/guardar-pedido', [PedidoController::class, 'store']);
Route::post('/upload-file', [FileController::class, 'upload'])->name('upload-file');
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->name('pedidos.update');
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');

Route::get('/girosOrders', [GiroController::class, 'index'])->name('girosOrders.index');
Route::get('/girosOrders/{id}', [GiroController::class, 'show'])->name('girosOrders.show');
Route::put('/girosOrders/{id}', [GiroController::class, 'update'])->name('girosOrders.update');
Route::delete('/girosOrders/{id}', [GiroController::class, 'destroy'])->name('girosOrders.destroy');
