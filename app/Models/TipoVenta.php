<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVenta extends Model
{
    protected $table = 'tipo_venta';

    protected $primaryKey = 'id_tipo_venta';


    public $timestamps = false;

    protected $fillable = [
        'tipo',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'tipo_venta_id_tipo_venta', 'id_tipo_venta');
    }
}
