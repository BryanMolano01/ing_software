<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'id_tipo_producto';
    public $timestamps = false;

    protected $fillable = [
        'tipo',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'tipo_producto_id_tipo_producto');
    }
}