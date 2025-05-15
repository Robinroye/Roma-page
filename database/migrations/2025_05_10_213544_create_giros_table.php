<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('giros', function (Blueprint $table) {
            $table->id();
            $table->string('user_phone'); // número de celular del cliente
            $table->string('tipo'); // impresión, giros, producto
            $table->decimal('total', 10, 2); // total del pedido
            $table->enum('estado', ['pendiente', 'pagado', 'despachado'])->default('pendiente'); // estado del pedido
            $table->json('detalles'); // JSON con los productos o ítems del pedido
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giros');
    }
};
