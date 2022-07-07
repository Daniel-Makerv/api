@component('mail::message')
# Asignación a centro deportivo

Hola {{ $auxiliar->nombre }}, el administrador {{ $admin->nombre_completo }} te 
ha agregado como administrador al centro deportivo {{ $centro->nombre }}, por lo que ahora ya puedes iniciar sesión 
en {{ config('app.name') }} con tus datos de acceso.

Te proporcionamos tus accesos:

<b>Correo:</b> {{ $auxiliar->email }} <br>
<b>Contraseña:</b> {{ $password }}

Saludos,<br>
{{ config('app.name') }}
@endcomponent

