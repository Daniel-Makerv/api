<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-{{ $color ?? 'primary' }}" target="_blank" rel="noopener">{{ $slot }}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

<p style="font-style: italic; font-size: 14px; text-align: justify;">
    Si el botón de arriba no funciona copia y pega el siguiente enlace en la barra de direcciones de tu navegador: <a href="{{ $url }}">{{ $url }}</a>
</p>