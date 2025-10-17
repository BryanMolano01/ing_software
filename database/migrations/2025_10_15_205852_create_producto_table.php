<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_xxxxxx_create_producto_table.php
public function up(): void
{
    Schema::create('producto', function (Blueprint $table) {
        $table->id('id_producto');
        //$table->integer('estado_producto_id_estado_producto');
        //$table->integer('tipo_producto_id_tipo_producto');
        //$table->integer('tamano_producto_id_tamano_producto');
        $table->string('nombre', 45);
        $table->integer('precio');

        $table->foreignId('estado_producto_id_estado_producto')->constrained('estado_producto','id_estado_producto');
        $table->foreignId('tipo_producto_id_tipo_producto')->constrained('tipo_producto','id_tipo_producto');
        $table->foreignId('tamano_producto_id_tamano_producto')->constrained('tamano_producto','id_tamano_producto');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
