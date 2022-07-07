@component('mail::message')
# ¡El Comienzo 💪!

¡Hola {{ $usuario->nombre }}, te has registrado correctamente como atleta 😁 !
<br>te proporcionamos tu <b>No.usuario:{{ $usuario->uuid }} </b>
¡ya puedes iniciar sesión con los siguientes datos! 👀:

<b>Correo:</b> {{ $usuario->email }} <br>
<b>Contraseña:</b> {{ $password }}

Te recomendamos cambiar tu contraseña una vez hayas iniciado sesión por primera vez,
para una mayor seguridad.

Saludos,<br>
{{ config('app.name') }}
@endcomponent