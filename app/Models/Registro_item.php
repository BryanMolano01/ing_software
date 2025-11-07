<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registro_item extends Model
{
    use HasFactory;

    protected $table = 'registro_item';
    protected $primaryKey = 'id_registro_item';
    public $timestamps = false;

    protected $casts = [
        'fecha_hora_registro' => 'datetime', 
    ];
    protected $fillable = [
        
        'item_id_item',
        'fecha_hora_registro',
    ];

    public function usuario()
    {
        return $this->belongsTo(Item::class, 'item_id_item');
    }
}
