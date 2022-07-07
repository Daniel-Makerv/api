@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

<span style="font-size: 14px">Mensaje enviado desde <a href="{{ config('app.url') }}">{{ config('app.name') }}</a></span>
<hr>
<p style="color: rgb(66, 66, 66); font-style: italic; text-align: justify; font-size: 12px;">
    El presente mensaje de correo electrónico y sus archivos anexos pueden contener información
    CONFIDENCIAL relacionada con datos personales y/o datos personales sensibles, y que han sido
    enviados exclusivamente al destinatario y deben ser utilizados para los fines convenidos con este.
    Si por alguna razón usted recibe este correo electrónico y no es el destinatario, favor de
    notificarlo inmediatamente al remitente y eliminar el mensaje incluyendo sus archivos anexos. Queda prohibida
    la retransmisión y uso de esta información para fines diferentes a los que se establecen en el
    aviso de privacidad el cual puede consultar en nuestra página electrónica {{ config('app.url') }}.
    En caso de incurrir en mal uso de la información o uso diferente al establecido será
    responsabilidad única de usted; deslindando de cualquier responsabilidad a
    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>.
</p>

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
