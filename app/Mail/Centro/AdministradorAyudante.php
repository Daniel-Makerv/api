<?php

namespace App\Mail\Centro;

use App\Models\Centros;
use App\Models\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdministradorAyudante extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $admin, $centro, $auxiliar, $password;
    public function __construct(Usuarios $admin, Centros $centro, Usuarios $auxiliar, String $password)
    {
        $this->admin = $admin->append('nombre_completo');
        $this->centro = $centro;
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
        return $this->markdown('emails.centro.administrador-ayudante')
        ->subject('Asignación a centro');
    }
}
