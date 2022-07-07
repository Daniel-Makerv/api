<?php

namespace App\Mail\Registro;

use App\Models\Empresas;
use App\Models\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Empresa extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $empresa, $usuario, $password;
    public function __construct(Empresas $empresa, Usuarios $usuario, $password)
    {
        $this->empresa = $empresa;
        $this->usuario = $usuario;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registro.empresa')
                    ->subject('Registro completo');
    }
}
