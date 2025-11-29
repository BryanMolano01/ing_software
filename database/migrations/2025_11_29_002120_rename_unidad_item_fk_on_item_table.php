<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('item', function (Blueprint $table) {
            $table->dropForeign(['unidad_item_id_unidad_materia_prima']);

            $table->renameColumn(
                'unidad_item_id_unidad_materia_prima',
                'unidad_item_id_unidad_item'
            );

            $table->foreign('unidad_item_id_unidad_item')
                ->references('id_unidad_item')
                ->on('unidad_item');
        });
    }

    public function down(): void
    {
        Schema::table('item', function (Blueprint $table) {
            $table->dropForeign(['unidad_item_id_unidad_item']);

            $table->renameColumn(
                'unidad_item_id_unidad_item',
                'unidad_item_id_unidad_materia_prima'
            );

            $table->foreign('unidad_item_id_unidad_materia_prima')
                ->references('id_unidad_item')
                ->on('unidad_item');
        });
    }
};
