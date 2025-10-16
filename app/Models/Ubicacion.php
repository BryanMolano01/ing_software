<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicacion';
    protected $primaryKey = 'id_ubicacion';
    public $timestamps = false;

    protected $fillable = [
        'ubicacion',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'ubicacion_id_ubicacion');
    }
}