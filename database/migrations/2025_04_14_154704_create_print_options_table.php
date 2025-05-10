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
        Schema::create('print_options', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_papel');  // bond, opalina, etc.
            $table->enum('color', ['bn', 'color']); // blanco y negro o color
            $table->integer('precio'); // precio por copia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_options');
    }
};
