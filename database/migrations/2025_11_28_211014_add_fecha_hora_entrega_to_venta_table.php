<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('venta', function (Blueprint $table) {

            $table->dateTime('fecha_hora_entrega')
                ->nullable()
                ->after('fecha_hora_venta');
        });
    }

    public function down(): void
    {
        Schema::table('venta', function (Blueprint $table) {
            $table->dropColumn('fecha_hora_entrega');
        });
    }
};
