<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('item', function (Blueprint $table) {
            // 1) Quitar la foreign key actual
            // Puedes usar el nombre de la FK o el nombre de la columna:
            $table->dropForeign(['unidad_item_id_unidad_materia_prima']);
            // Si te diera problemas, usa el nombre explícito:
            // $table->dropForeign('item_unidad_item_id_unidad_materia_prima_foreign');

            // 2) Renombrar la columna
            $table->renameColumn(
                'unidad_item_id_unidad_materia_prima',
                'unidad_item_id_unidad_item'
            );

            // 3) Crear la nueva foreign key con el nombre de columna correcto
            $table->foreign('unidad_item_id_unidad_item')
                ->references('id_unidad_item')
                ->on('unidad_item');
        });
    }

    public function down(): void
    {
        Schema::table('item', function (Blueprint $table) {
            // 1) Quitar la nueva foreign key
            $table->dropForeign(['unidad_item_id_unidad_item']);
            // o explícito:
            // $table->dropForeign('item_unidad_item_id_unidad_item_foreign');

            // 2) Volver al nombre anterior de la columna
            $table->renameColumn(
                'unidad_item_id_unidad_item',
                'unidad_item_id_unidad_materia_prima'
            );

            // 3) Restaurar la foreign key antigua
            $table->foreign('unidad_item_id_unidad_materia_prima')
                ->references('id_unidad_item')
                ->on('unidad_item');
        });
    }
};
