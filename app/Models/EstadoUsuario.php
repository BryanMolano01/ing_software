<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoUsuario extends Model
{
    use HasFactory;

    protected $table = 'estado_usuario';
    protected $primaryKey = 'id_estado_usuario';
    public $timestamps = false;

    protected $fillable = [
        'estado',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'estado_usuario_id_estado_usuario');
    }
}