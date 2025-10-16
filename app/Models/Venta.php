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
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id_usuario');
    }

    public function productos()
    {
        return $this->hasMany(VentaProducto::class, 'venta_id_venta');
    }
}