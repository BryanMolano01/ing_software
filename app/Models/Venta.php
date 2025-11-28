<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;

    protected $fillable = [
        'fecha_hora_venta',
        'total',
        'usuario_id_usuario',
        'tipo_venta_id_tipo_venta',
        'fecha_hora_entrega',
    ];
    protected $casts = [
        'fecha_hora_venta' => 'datetime',
        'fecha_hora_entrega' => 'datetime',
    ];


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id_usuario');
    }
    public function tipoVenta(){
        return $this->belongsTo(TipoVenta::class, 'tipo_venta_id_tipo_venta');
    }

    public function productos()
    {
        return $this->hasMany(VentaProducto::class, 'venta_id_venta');
    }
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'venta_id_venta');
    }
}
