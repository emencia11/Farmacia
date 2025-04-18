<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->dropForeign(['id_medicamento']);
            $table->dropColumn('id_medicamento');
            $table->dropColumn('cantidad');
            $table->dropColumn('motivo');

            $table->decimal('total', 10, 2)->default(0); // nuevo campo
        });
    }

    public function down(): void
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->unsignedBigInteger('id_medicamento');
            $table->integer('cantidad');
            $table->text('motivo')->nullable();

            $table->dropColumn('total');

            $table->foreign('id_medicamento')->references('id')->on('medicamentos');
        });
    }
};
