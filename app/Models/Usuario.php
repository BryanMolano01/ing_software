<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'fecha_registro',
        'rol_id_rol',
        'estado_usuario_id_estado_usuario',
    ];

    protected $hidden = ['password',];
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id_rol');
    }

    public function estadoUsuario()
    {
        return $this->belongsTo(EstadoUsuario::class, 'estado_usuario_id_estado_usuario');
    }

    public function registros()
    {
        return $this->hasMany(Registro::class, 'usuario_id_usuario');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'usuario_id_usuario');
    }
}