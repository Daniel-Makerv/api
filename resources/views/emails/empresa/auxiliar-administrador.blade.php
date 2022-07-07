@component('mail::message')
# Bienvenido

Hola {{ $auxiliar->nombre }}, el administrador {{ $admin->nombre_completo }} te ha registrado como auxiliar 
administrador de {{ $empresa->nombre_fiscal }}, ahora puedes iniciar sesión en {{ config('app.name') }} 
con los siguientes datos de acceso:

<b>Correo:</b> {{ $auxiliar->email }} <br>
<b>Contraseña:</b> {{ $password }}

Te recomendamos cambiar tu contraseña una vez hayas iniciado sesión por primera vez,
para una mayor seguridad.

Saludos,<br>
{{ config('app.name') }}
@endcomponent

