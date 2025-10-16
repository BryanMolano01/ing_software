<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_tipo_item_table.php
public function up(): void
{
    Schema::create('tipo_item', function (Blueprint $table) {
        $table->integer('id_tipo_item')->primary();
        $table->string('tipo', 45);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_item');
    }
};
