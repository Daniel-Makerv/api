<?php

namespace App\Mail\Empresa;

use App\Models\Empresas;
use App\Models\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuxiliarAdministrador extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $admin, $empresa, $auxiliar, $password;
    public function __construct(Usuarios $admin, Empresas $empresa, Usuarios $auxiliar, String $password)
    {
        $this->admin = $admin->append('nombre_completo');
        $this->empresa = $empresa;
        $this->auxiliar = $auxiliar;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.empresa.auxiliar-administrador')
                    ->subject('Bienvenido');
    }
}
