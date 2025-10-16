<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';
    protected $primaryKey = 'id_item';
    public $timestamps = false;

    protected $fillable = [
        'proveedor_id_proveedor',
        'tipo_item_id_tipo_item',
        'ubicacion_id_ubicacion',
        'cantidad',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id_proveedor');
    }

    public function tipoItem()
    {
        return $this->belongsTo(TipoItem::class, 'tipo_item_id_tipo_item');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id_ubicacion');
    }
}