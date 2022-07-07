<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiHelpers;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean']
        ]);

        $user = Usuarios::query()
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            $validation = ['email' => 'El email ingresado no se encuentra en nuestros registros'];
        } else if (!password_verify($request->password, $user->password)) {
            return response()->json(['La contraseña es incorrecta']);
        }
        if (isset($validation)) {
            throw ValidationException::withMessages($validation);
        }

        $login = auth()->login($user, $request->remember == true ? true : false);
        return $this->respondWithToken($login);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth()->user();
        return response()->json(
            $user->append(
                [
                    'nombre_completo',
                    'empresa',
                    'centro',
                    'rol_personal'
                ]
            )
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return ApiHelpers::msgSuccess('La sesión se ha cerrado correctamente');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function response()
    {
        return response()->json([
            'Status' => 200,
            'Company' => 'Ultra Cross TM™',
            'Website' => 'http://localhost:3000',
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
