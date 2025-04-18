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
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_medicamento');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 8, 2);
            $table->string('tipo'); // 'venta', 'devolucion', etc. - Esto lo usas para identificar si es una venta
            $table->unsignedBigInteger('id_usuario'); // vendedor que hizo la venta
            $table->timestamps();
        
            $table->foreign('id_medicamento')->references('id')->on('medicamentos');
            $table->foreign('id_usuario')->references('id')->on('users');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidas');
    }
};
