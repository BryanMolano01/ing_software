<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoItem extends Model
{
    use HasFactory;

    protected $table = 'tipo_item';
    protected $primaryKey = 'id_tipo_item';
    public $timestamps = false;

    protected $fillable = [
        'tipo',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'tipo_item_id_tipo_item');
    }
}