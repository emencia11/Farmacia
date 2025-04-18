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
            $table->unsignedBigInteger('id_proveedor')->after('id_categoria'); // Nueva columna id_proveedor
            $table->foreign('id_proveedor')->references('id')->on('proveedores'); // Relación con la tabla proveedores
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->dropForeign(['id_proveedor']); // Eliminar la relación
            $table->dropColumn('id_proveedor'); // Eliminar la columna
        });
    }
};