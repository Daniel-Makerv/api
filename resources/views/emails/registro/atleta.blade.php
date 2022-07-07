@component('mail::message')
# ¡El Comienzo 💪!

¡Hola {{ $usuario->nombre }}, te has registrado como atleta correctamente 😁 !
<br>proporciona tu <b>No.usuario:{{ $usuario->uuid }} </b> al administrador de tu 
centro para poder iniciar sesión. tus futuros datos de acceso son los siguientes 👀:

<b>Correo:</b> {{ $usuario->email }} <br>
<b>Contraseña:</b> {{ $password }}

Te recomendamos cambiar tu contraseña una vez hayas iniciado sesión por primera vez,
para una mayor seguridad.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
