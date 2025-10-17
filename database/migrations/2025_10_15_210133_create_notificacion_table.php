<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // database/migrations/xxxx_xx_xx_xxxxxx_create_notificacion_table.php
public function up(): void
{
    Schema::create('notificacion', function (Blueprint $table) {
        $table->id('id_notificacion');
        $table->string('notificacion', 200);
        //$table->integer('producto_id_producto');
        $table->dateTime('fecha_hora_notificacion');

        $table->foreignId('producto_id_producto')->constrained('producto','id_producto');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion');
    }
};
