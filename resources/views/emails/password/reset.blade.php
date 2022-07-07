@component('mail::message')
# Recupera tu contraseña

Hola {{ $usuario->nombre }}, te enviamos este correo ya que solicitaste recuperar tu contraseña
si no reconoces esta solicitud elimina este mensaje, en caso contrario da clic en el botón de abajo 
para continuar con la operación:

@component('mail::button', ['url' => config('app.url').'/password/reset/'.$token])
Recuperar contraseña
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
