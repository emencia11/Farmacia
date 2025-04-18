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
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('id_unidad_medida');
            $table->date('fecha_vencimiento');
            $table->integer('stock')->default(0); // Cantidad actual disponible
            $table->decimal('precio_unitario', 8, 2);
            $table->unsignedBigInteger('id_categoria');
            $table->integer('cantidad_por_empaque'); // Cantidad por empaque
            $table->unsignedBigInteger('id_proveedor'); // Relación con la tabla de proveedores
            $table->string('estado')->default('activo'); // Estado del medicamento (activo o descontinuado)
            $table->date('fecha_fabricacion')->nullable(); // Fecha de fabricación
            $table->timestamps();
        
            // Relación con las tablas
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_unidad_medida')->references('id')->on('unidades_medida');
            $table->foreign('id_proveedor')->references('id')->on('proveedores'); // Relación con proveedores
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};