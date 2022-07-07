<?php

namespace App\Mail\Password;

use App\Models\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario, $token;
    public function __construct(Usuarios $usuario, $token)
    {
        $this->usuario = $usuario;
        $this->token = Crypt::encrypt($token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.password.reset')
                    ->subject('Recupera tu contraseña');
    }
}
