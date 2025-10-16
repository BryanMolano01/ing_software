<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_item_table.php
public function up(): void
{
    Schema::create('item', function (Blueprint $table) {
        $table->integer('id_item')->primary();
        $table->integer('proveedor_id_proveedor');
        $table->integer('tipo_item_id_tipo_item');
        $table->integer('ubicacion_id_ubicacion');
        $table->integer('cantidad');

        $table->foreign('proveedor_id_proveedor')->references('id_proveedor')->on('proveedor');
        $table->foreign('tipo_item_id_tipo_item')->references('id_tipo_item')->on('tipo_item');
        $table->foreign('ubicacion_id_ubicacion')->references('id_ubicacion')->on('ubicacion');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
