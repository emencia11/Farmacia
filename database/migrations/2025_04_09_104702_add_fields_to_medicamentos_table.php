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
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->decimal('precio_por_empaque', 8, 2)->nullable(); // Precio por empaque
            $table->integer('cantidad_por_empaque'); // Cantidad por empaque
            $table->string('estado')->default('activo'); // Estado del medicamento
            $table->date('fecha_fabricacion')->nullable(); // Fecha de fabricación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->dropColumn(['precio_por_empaque', 'cantidad_por_empaque', 'estado', 'fecha_fabricacion']);
        });
    }
};