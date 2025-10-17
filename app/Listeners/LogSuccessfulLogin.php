<?php

namespace App\Listeners;

use App\Models\Registro;
use App\Models\Usuario;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        if ($event->user instanceof Usuario) {
            Registro::create([
                'usuario_id_usuario' => $event->user->id_usuario,
                'fecha_hora_registro' => now(),
            ]);
        }
    }
}