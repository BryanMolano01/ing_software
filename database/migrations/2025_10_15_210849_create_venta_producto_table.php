<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_venta_producto_table.php
public function up(): void
{
    Schema::create('venta_producto', function (Blueprint $table) {
        $table->id('id_venta_producto');
        //$table->integer('producto_id_producto');
        $table->integer('cantidad');
        $table->integer('precio_unitario');
        $table->integer('subtotal');
        //$table->integer('venta_id_venta');

        $table->foreignId('producto_id_producto')->constrained('producto','id_producto');
        $table->foreignId('venta_id_venta')->constrained('venta','id_venta');
    });
}   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_producto');
    }
};
