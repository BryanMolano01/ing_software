<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'registro';
    protected $primaryKey = 'id_registro';
    public $timestamps = false;

    protected $casts = [
        'fecha_hora_registro' => 'datetime', 
    ];
    protected $fillable = [
        
        'usuario_id_usuario',
        'fecha_hora_registro',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id_usuario');
    }
}