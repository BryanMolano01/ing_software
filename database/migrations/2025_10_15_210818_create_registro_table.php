<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_registro_table.php
public function up(): void
{
    Schema::create('registro', function (Blueprint $table) {
        $table->integer('id_registro')->primary();
        $table->dateTime('fecha_hora_registro');
        $table->integer('usuario_id_usuario');

        $table->foreign('usuario_id_usuario')->references('id_usuario')->on('usuario');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro');
    }
};
