<?php

namespace App\Mail\Centro;

use App\Models\Centros;
use App\Models\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdministradorAsignado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $administrador_empresa, $administrador_centro, $centro;
    public function __construct(Usuarios $admin, Usuarios $administrador_centro, Centros $centro)
    {
        $this->administrador_empresa = $admin->append('nombre_completo');
        $this->administrador_centro = $administrador_centro;
        $this->centro = $centro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.centro.administrador-asignado')
        ->subject('Asignación a centro');
    }
}
