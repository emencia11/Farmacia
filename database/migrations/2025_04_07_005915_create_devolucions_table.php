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
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_medicamento');
            $table->integer('cantidad');
            $table->text('motivo')->nullable();
            $table->unsignedBigInteger('id_usuario'); // quién registró la devolución
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
        Schema::dropIfExists('devoluciones');
    }
};
