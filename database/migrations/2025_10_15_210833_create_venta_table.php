<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_venta_table.php
public function up(): void
{
    Schema::create('venta', function (Blueprint $table) {
        /*$table->integer('id_venta')->primary();
        $table->dateTime('fecha_hora_venta');
        $table->integer('total');
        $table->integer('usuario_id_usuario');

        $table->foreign('usuario_id_usuario')->references('id_usuario')->on('usuario');
*/


        $table->id('id_venta'); // puedes mantener integer si quieres
        $table->dateTime('fecha_hora_venta');
        $table->integer('total');

        // Cambiar a unsignedBigInteger para que coincida con id('id_usuario')
        //$table->unsignedBigInteger('usuario_id_usuario');

        $table->foreignId('usuario_id_usuario')->constrained('usuario','id_usuario');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
