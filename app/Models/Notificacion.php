<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificacion';
    protected $primaryKey = 'id_notificacion';
    public $timestamps = false;
    protected $casts = [
        'fecha_hora_notificacion' => 'datetime',
    ];
    protected $fillable = [
        'notificacion',
        'producto_id_producto',
        'venta_id_venta',
        'fecha_hora_notificacion',
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
