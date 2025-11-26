<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('unidad_materia_prima', 'unidad_item');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('unidad_item', 'unidad_materia_prima');
    }
};
