<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detalle_devoluciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('devolucion_id');
            $table->unsignedBigInteger('medicamento_id');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->text('motivo')->nullable();
            $table->timestamps();

            $table->foreign('devolucion_id')->references('id')->on('devoluciones')->onDelete('cascade');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_devoluciones');
    }
};
