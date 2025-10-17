<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Correcto, hereda de Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 
        'email',
        'password',
        'fecha_registro',
        'rol_id_rol',
        'estado_usuario_id_estado_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];


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