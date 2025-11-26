<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('item', function (Blueprint $table) {
            $table->dropForeign(['unidad_materia_prima_id_unidad_materia_prima']);

            $table->renameColumn(
                'unidad_materia_prima_id_unidad_materia_prima',
                'unidad_item_id_unidad_materia_prima' // <-- cambia este nombre si quieres otro
            );

            $table->foreign('unidad_item_id_unidad_materia_prima')
                ->references('id_unidad_materia_prima')
                ->on('unidad_item');
        });
    }

    public function down(): void
    {
        Schema::table('item', function (Blueprint $table) {
            $table->dropForeign(['unidad_item_id_unidad_materia_prima']);

            $table->renameColumn(
                'unidad_item_id_unidad_materia_prima',
                'unidad_materia_prima_id_unidad_materia_prima'
            );

            $table->foreign('unidad_materia_prima_id_unidad_materia_prima')
                ->references('id_unidad_materia_prima')
                ->on('unidad_item');
        });
    }
};
