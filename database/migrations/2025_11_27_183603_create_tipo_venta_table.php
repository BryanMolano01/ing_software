<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_venta', function (Blueprint $table) {
            $table->id('id_tipo_venta');
            $table->string('tipo', 45);
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_venta');
    }
};
