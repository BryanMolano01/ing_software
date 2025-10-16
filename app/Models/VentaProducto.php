<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    use HasFactory;

    protected $table = 'venta_producto';
    protected $primaryKey = 'id_venta_producto';
    public $timestamps = false;

    protected $fillable = [
        'producto_id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'venta_id_venta',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id_producto');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id_venta');
    }
}