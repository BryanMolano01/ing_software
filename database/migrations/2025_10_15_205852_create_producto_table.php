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
        $table->integer('id_producto')->primary();
        $table->integer('estado_producto_id_estado_producto');
        $table->integer('tipo_producto_id_tipo_producto');
        $table->integer('tamano_producto_id_tamano_producto');
        $table->string('nombre', 45);
        $table->integer('precio');

        $table->foreign('estado_producto_id_estado_producto')->references('id_estado_producto')->on('estado_producto');
        $table->foreign('tipo_producto_id_tipo_producto')->references('id_tipo_producto')->on('tipo_producto');
        $table->foreign('tamano_producto_id_tamano_producto')->references('id_tamano_producto')->on('tamano_producto');
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
