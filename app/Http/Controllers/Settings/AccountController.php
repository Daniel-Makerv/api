<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\Password as PasswordMail;
use App\Http\Requests\Usuario as UsuarioRequest;

class AccountController extends Controller
{

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UsuarioRequest\Update $request)
    {
        $user = $request->user();

        $user->update([
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email'            => $request->email,
            'telefono'         => $request->telefono,
            'sexo'             => $request->sexo,
        ]);

        return ApiHelpers::msgSuccessStore('Se actualizó la información');
    }
    public function updateAvatarProfile(UsuarioRequest\UpdateAvatar $request){

        //subir imagen de perfil
        $exploded = explode(',', $request->avatar);
        $decoded = base64_decode($exploded[1]);

        if (str_contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        }
        else{
            $extension = 'png';
        }
        $fileName = auth()->id('id').'-'.auth()->user()->nombre.'-'.Str::random().'.'.$extension;
        $path = public_path('fotos_perfiles').'/'.$fileName;
        file_put_contents($path, $decoded);

        $user = $request->user();

        $user->update([
            'avatar'  => $fileName,
        ]);

        return ApiHelpers::msgSuccessStore('Se actualizó la foto de perfil');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!password_verify($request->old_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'old_password' => 'La contraseña actual es incorrecta'
            ]);
        }

        if($request->new_password == $request->old_password){
            throw ValidationException::withMessages([
                'new_password' => 'Tu nueva contraseña no puede ser la misma que la actual'
            ]);
        }

        Mail::to(auth()->user()->email)->send(new PasswordMail\Cambio(auth()->user()));
        if (Mail::failures()) {
            return ApiHelpers::msgServerError('Ocurrió un error #01');
        }

        auth()->user()->update([
            'password' => bcrypt($request->new_password)
        ]);

        return ApiHelpers::msgSuccessStore('Se actualizó la contraseña');
    }
}
