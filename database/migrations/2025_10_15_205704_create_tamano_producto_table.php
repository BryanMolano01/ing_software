<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_tamano_producto_table.php
public function up(): void
{
    Schema::create('tamano_producto', function (Blueprint $table) {
        $table->integer('id_tamano_producto')->primary();
        $table->string('tamano', 45);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamano_producto');
    }
};
