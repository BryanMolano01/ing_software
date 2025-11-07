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


        Schema::create('registro_item', function (Blueprint $table) {
            $table->id('id_registro');
            $table->dateTime('fecha_hora_registro');
            $table->foreignId('item_id_item')->constrained('item', 'id_item');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_items');
    }
};
