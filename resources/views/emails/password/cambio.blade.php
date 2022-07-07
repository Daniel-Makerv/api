@component('mail::message')
# Tu contraseña cambió

Hola {{ $user->nombre }}, te enviamos esta notificación ya que se cambió la contraseña 
de acceso de tu correo electrónico <b>{{ $user->email }}</b> en {{ config('app.name') }} 
si no reconoces esta acción ponte en contacto con nuestro equipo para crear una solicitud de 
recuperación de tu cuenta. 


Saludos,<br>
{{ config('app.name') }}
@endcomponent
