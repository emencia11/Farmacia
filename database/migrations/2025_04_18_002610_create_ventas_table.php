<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    public function down(): void {
        Schema::dropIfExists('ventas');
    }
};