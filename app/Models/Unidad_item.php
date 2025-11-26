<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unidad_item extends Model
{
     use HasFactory;

    protected $table = 'unidad_item';
    protected $primaryKey = 'id_unidad_item';
    public $timestamps = false;

    protected $fillable = [
        'unidad',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'unidad_item_id_unidad_item');
    }
}
