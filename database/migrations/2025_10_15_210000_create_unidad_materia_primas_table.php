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
        Schema::create('unidad_materia_prima', function (Blueprint $table) {
            // Use a string name or no argument. Using the string keeps your custom column name.
            $table->id('id_unidad_materia_prima');
            $table->string('unidad', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // The up() creates 'unidad_materia_prima' so down() must drop the same table name
        Schema::dropIfExists('unidad_materia_prima');
    }
};

