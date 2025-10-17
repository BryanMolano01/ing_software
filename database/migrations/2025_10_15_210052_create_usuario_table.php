<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_usuario_table.php
public function up(): void
{
    Schema::create('usuario', function (Blueprint $table) {
        $table->integer('id_usuario')->primary()->autoIncrement();
        $table->string('nombre'); // Campo 'name' que Breeze puede usar
        $table->string('email', 100)->unique();
        $table->string('password');
        $table->date('fecha_registro');
        $table->integer('rol_id_rol');
        $table->integer('estado_usuario_id_estado_usuario');
        $table->rememberToken(); // Columna para "Recordarme"
        

        $table->foreign('rol_id_rol')->references('id_rol')->on('rol');
        $table->foreign('estado_usuario_id_estado_usuario')->references('id_estado_usuario')->on('estado_usuario');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
