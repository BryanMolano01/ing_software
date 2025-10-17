<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Registro;
use App\Models\Usuario;
class LogSuccessfulLoginUsuario
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
            \Log::info('Evento de login detectado para usuario: ' . $event->user->email);

            Registro::create([
                'usuario_id_usuario' => $event->user->id_usuario,
                'fecha_hora_registro' => now(),
            ]);
        }
    }
}
