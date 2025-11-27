<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('venta', function (Blueprint $table) {

            $table->unsignedBigInteger('tipo_venta_id_tipo_venta')
                ->default(1)
                ->after('total');

            $table->foreign('tipo_venta_id_tipo_venta')
                ->references('id_tipo_venta')
                ->on('tipo_venta');

            if (Schema::hasColumn('venta', 'tipo_venta')) {
                $table->dropColumn('tipo_venta');
            }
        });
    }

    public function down(): void
    {
        Schema::table('venta', function (Blueprint $table) {
            $table->dropForeign('venta_tipo_venta_id_tipo_venta_foreign');
            $table->dropColumn('tipo_venta_id_tipo_venta');

            $table->string('tipo_venta', 20)
                ->default('venta')
                ->after('total');
        });
    }
};
