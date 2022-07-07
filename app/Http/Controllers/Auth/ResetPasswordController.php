<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Usuarios;
use App\Helpers\ApiHelpers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordResets;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\Password as PasswordMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Password as PasswordRequest;
use Illuminate\Contracts\Encryption\DecryptException;

class ResetPasswordController extends Controller
{
    public function email(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'indisposable']
        ]);

        $buscar_token = PasswordResets::query()
            ->where('email', $request->email)
            ->first();

        if ($buscar_token) {
            $tiempo_restante = $this->checkTheRemainingTimeOfExpiration($buscar_token->created_at);
            if ($tiempo_restante > 0) {
                $label = $tiempo_restante > 1 ? 'minutos' : 'minutos';
                return ApiHelpers::msgClientError("Ya se ha solicitado reestablecer la contraseña de este correo electrónico, por lo que hay que esperar {$tiempo_restante} {$label} para poder realizar una nueva petición");
            } else {
                $buscar_token->delete();
            }
        }

        $usuario = Usuarios::query()
            ->where('email', $request->email)
            ->first();

        if (!$usuario) {
            throw ValidationException::withMessages([
                'email' => 'El correo no se encuentra en nuestros registros'
            ]);
        }

        $registrar_token = PasswordResets::create([
            'email' => $request->email,
            'token' => Str::random(64)
        ]);

        Mail::to($request->email)->send(new PasswordMail\Reset($usuario, $registrar_token->token));

        if (Mail::failures()) {
            $registrar_token->delete();
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #01');
        }

        return ApiHelpers::msgSuccessStore("Se ha enviado un enlace al correo electrónico para poder reestablecer la contraseña");
    }

    public function verifyToken($token)
    {
        try {
            $token_decrypted = Crypt::decrypt($token);
        } catch (DecryptException $e) {
            return ApiHelpers::msgClientError('El token es inválido #01');
        }

        $buscar_token = PasswordResets::query()
            ->where('token', $token_decrypted)
            ->first();

        if (!$buscar_token) {
            return ApiHelpers::msgClientError('El token ya expiró #02');
        }

        $tiempo_restante = $this->checkTheRemainingTimeOfExpiration($buscar_token->created_at);
        if ($tiempo_restante == 0) {
            $buscar_token->delete();
            return ApiHelpers::msgClientError('El token ya expiró #03');
        }

        $usuario = Usuarios::query()
            ->where('email', $buscar_token->email)
            ->first();

        if (!$usuario) {
            $buscar_token->delete();
            return ApiHelpers::msgClientError('El token ya expiró #04');
        }

        return response()->json(['usuario' => $usuario], 200);
    }

    public function reset($token, Request $request)
    {
        try {
            $token_decrypted = Crypt::decrypt($token);
        } catch (DecryptException $e) {
            return ApiHelpers::msgClientError('El token es inválido #01');
        }

        $buscar_token = PasswordResets::query()
            ->where('token', $token_decrypted)
            ->first();

        if (!$buscar_token) {
            return ApiHelpers::msgClientError('El token ya expiró #02');
        }

        $usuario = Usuarios::query()
            ->where('email', $buscar_token->email)
            ->first();

        if (!$usuario) {
            $buscar_token->delete();
            return ApiHelpers::msgClientError('El token ya expiró #03');
        }

        $validarContraseña = Validator::make($request->all(), PasswordRequest\Store::rules());
        if ($validarContraseña->fails()) {
            return ApiHelpers::sendErrorsValidator($validarContraseña->errors());
        }

        if (password_verify($request->password, $usuario->password)) {
            throw ValidationException::withMessages([
                'password' => 'La nueva contraseña no puede ser la misma que la anterior'
            ]);
        }

        $actualizar_contraseña = $usuario->update([
            'password' => bcrypt($request->password)
        ]);

        $buscar_token->delete();

        return ApiHelpers::msgSuccessStore('Se ha reestablecido la contraseña');
    }

    public function checkTheRemainingTimeOfExpiration(Carbon $created_at)
    {
        $tiempo_indicado_de_expiracion_en_minutos = config('app.reset_password_expiration_token_in_minutes');
        $tiempo_transcurrido_en_minutos = $created_at->diffInMinutes(Carbon::now());
        if ($tiempo_transcurrido_en_minutos < $tiempo_indicado_de_expiracion_en_minutos) {
            $resultado = $tiempo_indicado_de_expiracion_en_minutos - $tiempo_transcurrido_en_minutos;
        } else {
            $resultado = 0;
        }
        return $resultado;
    }
}
