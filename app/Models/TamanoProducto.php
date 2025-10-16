<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamanoProducto extends Model
{
    use HasFactory;

    protected $table = 'tamano_producto';
    protected $primaryKey = 'id_tamano_producto';
    public $timestamps = false;

    protected $fillable = [
        'tamano',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'tamano_producto_id_tamano_producto');
    }
}