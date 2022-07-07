<?php

namespace App\Mail\Registro;

use App\Models\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Atleta extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario, $password, $uuid;
    public function __construct(Usuarios $usuario, $password, $uuid)
    {
        $this->usuario = $usuario;
        $this->uuid = $uuid;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registro.atleta')
                    ->subject('Registro completo');
    }
}
