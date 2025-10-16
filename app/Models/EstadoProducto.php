<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoProducto extends Model
{
    use HasFactory;

    protected $table = 'estado_producto';
    protected $primaryKey = 'id_estado_producto';
    public $timestamps = false;

    protected $fillable = [
        'estado',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'estado_producto_id_estado_producto');
    }
}