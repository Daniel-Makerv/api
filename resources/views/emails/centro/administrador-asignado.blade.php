@component('mail::message')
# Asignación a centro deportivo

Hola {{ $administrador_centro->nombre }}, el administrador {{ $administrador_empresa->nombre_completo }} te 
ha asignado al centro deportivo {{ $centro->nombre }} por lo que ahora ya puedes iniciar sesión 
en {{ config('app.name') }} con tus datos de acceso.


<b>Correo:</b> {{ $administrador_centro->email }} <br>


Saludos,<br>
{{ config('app.name') }}
@endcomponent

