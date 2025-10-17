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
        $table->id('id_item');
        //$table->integer('proveedor_id_proveedor');
        //$table->integer('tipo_item_id_tipo_item');
        //$table->integer('ubicacion_id_ubicacion');
        $table->integer('cantidad');

        $table->foreignId('proveedor_id_proveedor')->constrained('proveedor', 'id_proveedor');
        $table->foreignId('tipo_item_id_tipo_item')->constrained('tipo_item','id_tipo_item');
        $table->foreignId('ubicacion_id_ubicacion')->constrained('ubicacion','id_ubicacion');
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
