@component('mail::message')
# Bienvenido

Hola {{ $administrador_centro->nombre }}, el administrador {{ $administrador_empresa->nombre_completo }} te 
ha registrado como administrador de centro deportivo, sin embargo aun no tienes una asignación, te avisaremos cuando
puedas iniciar sesión en {{ config('app.name') }}, por lo mientras te proporcionamos tus futuros datos de acceso:

<b>Correo:</b> {{ $administrador_centro->email }} <br>
<b>Contraseña:</b> {{ $password }}

Te recomendamos cambiar tu contraseña una vez puedas iniciar sesión por primera vez,
para una mayor seguridad.

Saludos,<br>
{{ config('app.name') }}
@endcomponent

