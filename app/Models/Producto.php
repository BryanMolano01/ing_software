<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'estado_producto_id_estado_producto',
        'tipo_producto_id_tipo_producto',
        'tamano_producto_id_tamano_producto',
        'nombre',
        'precio',
    ];

    public function estadoProducto()
    {
        return $this->belongsTo(EstadoProducto::class, 'estado_producto_id_estado_producto');
    }

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_producto_id_tipo_producto');
    }

    public function tamanoProducto()
    {
        return $this->belongsTo(TamanoProducto::class, 'tamano_producto_id_tamano_producto');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'producto_id_producto');
    }

    public function ventas()
    {
        return $this->hasMany(VentaProducto::class, 'producto_id_producto');
    }
}