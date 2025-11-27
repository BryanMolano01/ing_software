<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notificacion', function (Blueprint $table) {
            // 1) Quitar FK actual de producto
            $table->dropForeign('notificacion_producto_id_producto_foreign');

            // 2) Hacer la columna nullable
            $table->unsignedBigInteger('producto_id_producto')
                ->nullable()
                ->change();

            // 3) Volver a crear la FK (ahora permite NULL)
            $table->foreign('producto_id_producto')
                ->references('id_producto')
                ->on('producto');

            // 4) Añadir nueva columna FK nullable a venta
            $table->foreignId('venta_id_venta')
                ->nullable()
                ->constrained('venta', 'id_venta');
        });
    }

    public function down(): void
    {
        Schema::table('notificacion', function (Blueprint $table) {
            // 1) Eliminar FK de venta y columna
            $table->dropForeign('notificacion_venta_id_venta_foreign');
            $table->dropColumn('venta_id_venta');

            // 2) Eliminar FK de producto
            $table->dropForeign('notificacion_producto_id_producto_foreign');

            // 3) Volver a NOT NULL
            $table->unsignedBigInteger('producto_id_producto')
                ->nullable(false)
                ->change();

            // 4) Restaurar FK original (NOT NULL)
            $table->foreign('producto_id_producto')
                ->references('id_producto')
                ->on('producto');
        });
    }
};
