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
        Schema::table('unidad_item', function (Blueprint $table) {
            // Renombrar la columna primaria
            $table->renameColumn('id_unidad_materia_prima', 'id_unidad_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unidad_item', function (Blueprint $table) {
            // Volver al nombre anterior si se hace rollback
            $table->renameColumn('id_unidad_item', 'id_unidad_materia_prima');
        });
    }
};
