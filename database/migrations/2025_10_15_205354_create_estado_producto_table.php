<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_estado_producto_table.php
public function up(): void
{
    Schema::create('estado_producto', function (Blueprint $table) {
        $table->integer('id_estado_producto')->primary();
        $table->string('estado', 45);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_producto');
    }
};
