@component('mail::message')
# Registro completo

Hola {{ $usuario->nombre }}, tu empresa "{{ $empresa->nombre_fiscal }}" se ha registrado correctamente,
ahora puedes iniciar sesión como administrador de tu empresa en {{ config('app.name') }} con los 
siguientes datos de acceso:

<b>Correo:</b> {{ $usuario->email }} <br>
<b>Contraseña:</b> {{ $password }}

Te recomendamos cambiar tu contraseña una vez hayas iniciado sesión por primera vez,
para una mayor seguridad.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
