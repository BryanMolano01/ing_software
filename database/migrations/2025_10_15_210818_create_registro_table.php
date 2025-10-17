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
            $table->id('id_registro');
            $table->dateTime('fecha_hora_registro');
            $table->foreignId('usuario_id_usuario')->constrained('usuario', 'id_usuario');
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
