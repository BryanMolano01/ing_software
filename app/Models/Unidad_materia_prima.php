<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unidad_materia_prima extends Model
{
     use HasFactory;

    protected $table = 'unidad_materia_prima';
    protected $primaryKey = 'id_unidad_materia_prima';
    public $timestamps = false;

    protected $fillable = [
        'unidad',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'unidad_materia_prima_id_unidad_materia_prima');
    }
}
