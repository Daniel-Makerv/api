<?php

namespace App\Helpers;

use App\Models\Centros;
use App\Models\Personal;
use App\Models\PersonalCentro;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Usuarios;
use App\Models\Atleta;
use App\Models\RolesPersonal;
use App\Models\CaracteristicasPlanes;
use App\Models\CaracteristicasSistema;
use phpDocumentor\Reflection\Types\Boolean;

class ApiHelpers
{
    /**
     *  Retorna los errores de validación de la librería Validator
     */
    public static function sendErrorsValidator(Object $errors, String $dataName = '')
    {
        if ($dataName != '') {
            return response()->json(['errors' => [$dataName => $errors]], 422);
        } else {
            return response()->json(['errors' => $errors], 422);
        }
    }

    /**
     *  Retorna un mensaje
     */
    private function message(String $type, String $title, String $text, Int $statusCode)
    {
        return response()->json(
            [
                'message' => [
                    'type'  => $type,
                    'title' => $title,
                    'text'  => $text
                ]
            ],
            $statusCode
        );
    }

    /**
     *  Retorna un mensaje de tipo 'success 200'
     */
    public static function msgSuccess(String $text, String $title = 'Correcto')
    {
        return (new Self)->message('success', $title, $text, 200);
    }

    /**
     *  Retorna un mensaje de tipo 'success 201'
     */
    public static function msgSuccessStore(String $text, String $title = 'Correcto')
    {
        return (new Self)->message('success', $title, $text, 201);
    }

    /**
     *  Retorna un mensaje de tipo 'error 500'
     */
    public static function msgServerError(String $text, String $title = 'Oh no')
    {
        return (new Self)->message('error', $title, $text, 500);
    }

    /**
     *  Retorna un mensaje de tipo 'error 422'
     */
    public static function msgClientError(String $text, String $title = 'Oh no')
    {
        return (new Self)->message('error', $title, $text, 422);
    }

    /**
     *  Retorna un mensaje de tipo 'error 404'
     */
    public static function msgNotFound(String $text, String $title = 'Oh no')
    {
        return (new Self)->message('error', $title, $text, 404);
    }


    /**
     *  Retorna un mensaje de tipo 'error 401'
     */
    public static function msgAuthorizationError(String $text = 'No tienes autorización para realizar esta acción', String $title = 'No autorizado')
    {
        return (new Self)->message('error', $title, $text, 401);
    }

    /**
     * Retorna un mensaje de error por limite de plan
     */
    public static function msgLimitError(String $text = 'Has alcanzado el limite para realizar esta acción', String $title = 'No autorizado')
    {
        return (new Self)->message('error', $title, $text, 401);
    }

    /**
     *  Retorna un mensaje de tipo 'error 401'
     */
    public static function msgPlanError(String $text = 'Para continuar debes adquirir un plan', String $title = 'No autorizado')
    {
        return (new Self)->message('error', $title, $text, 401);
    }

    /**
     * Verifica que el usuario que deseas utilizar sea de tu propiedad
     */
    public static function canUsePersonal($idPersonal)
    {
        $personal = Usuarios::query()
            ->where('id', $idPersonal)
            ->first();


        if (!$personal) {
            return false;
        }

        $user = auth()->user();
        switch ($user->id_rol_sistema) {
            case 1: #Root
                return true;
                break;

            case 2: #Empresa
                $verify = Personal::query()
                    ->where('id_empresa', $user->empresa->id)
                    ->where('id_usuario', $personal->id)
                    ->first();

                if (!$verify) {
                    return false;
                }

                if (!ApiHelpers::canUseRolPersonal($verify->id_rol_personal)) {
                    return false;
                }

                return true;
                break;
            case 3: #centro
                $verify = Personal::query()
                    ->where('id_centro', $user->centro->id)
                    ->where('id_usuario', $personal->id)
                    ->first();

                if (!$verify) {
                    return false;
                }
                //aqui es
                if (!ApiHelpers::canUseRolPersonal($verify->id_rol_personal)) {
                    return false;
                }

                return true;
                break;
            case 4: #atleta
                $verify = Personal::query()
                    ->where('id_centro', $user->centro->id)
                    ->where('id_usuario', $personal->id)
                    ->first();

                if (!$verify) {
                    return false;
                }
                //aqui es
                if (!ApiHelpers::canUseRolPersonal($verify->id_rol_personal)) {
                    return false;
                }

                return true;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Verifica que el usuario que deseas utilizar sea el correcto y sea de tu propiedad
     */
    public static function userExpected($idUser, $rolSistema, $rolPersonal = null)
    {
        $user = Usuarios::query()
            ->where('id', $idUser)
            ->where('id_rol_sistema', $rolSistema)
            ->first();

        if (!$user) {
            return false;
        }

        if ($rolPersonal != null) {
            $personal = Personal::query()
                ->where('id_usuario', $user->id)
                ->where('id_rol_personal', $rolPersonal)
                ->first();

            if (!$personal) {
                return false;
            }
        }

        $user = auth()->user();
        switch ($user->id_rol_sistema) {
            case 1: #Root
                return true;
                break;

            case 2: #Empresa
                $verify = Personal::query()
                    ->where('id_empresa', $user->empresa->id)
                    ->where('id_usuario', $personal->id)
                    ->first();

                if (!$verify) {
                    return false;
                }

                if (!ApiHelpers::canUseRolPersonal($verify->id_rol_personal)) {
                    return false;
                }

                return true;
                break;

            default:
                return false;
                break;
        }

        return true;
    }

    /**
     * Verifica que el centro que deseas utilizar sea de tu propiedad
     */
    public static function canUseCentro($id_centro)
    {
        $auth = auth()->user();
        $centro = Centros::query()
            ->where('id', $id_centro)
            ->first();

        if (!$centro) {
            return false;
        }

        switch ($auth->id_rol_sistema) {
            case 1: #Root
                return true;
                break;

            case 2: #Empresa
                switch ($auth->rol_personal->id) {
                    case 1: #Administrador de empresa
                    case 2: #Auxiliar administrador
                        if ($centro->id_empresa != $auth->empresa->id) {
                            return false;
                        }
                        return true;
                        break;

                    default:
                        return false;
                        break;
                }
                break;

            default:
                return false;
                break;
        }
    }

    /**
     * Verifica que puedas usar el rol personal
     */
    public static function canUseRolPersonal($idItem)
    {
        $rolPersonal = RolesPersonal::query()
            ->where('id', $idItem)
            ->first();

        if (!$rolPersonal) {
            return false;
        }

        $auth = auth()->user();
        switch ($auth->id_rol_sistema) {
            case 1: #Root
                return true;
                break;

            case 2: #Empresa
                switch ($auth->rol_personal->id) {
                    case 1: #Administrador de empresa
                        switch ($rolPersonal->id) {
                            case 2: #Auxiliar administrador de empresa
                            case 3: #Administrador de centro
                                return true;
                                break;
                            case 4:
                                return true;
                                break;
                            case 5:
                                return true;
                                break;
                            case 6:
                                return true;
                                break;
                            case 7:
                                return true;
                                break;
                            case 8:
                                return true;
                                break;

                            default:
                                return false;
                                break;
                        }
                        break;

                    case 2: #Auxiliar administrador de empresa
                        switch ($rolPersonal->id) {
                            case 3: #Administrador de centro  
                                return true;
                                break;
                            case 4:
                                return true;
                                break;
                            case 5:
                                return true;
                                break;
                            case 6:
                                return true;
                                break;
                            case 7:
                                return true;
                                break;
                            case 8:
                                return true;
                                break;

                            default:
                                return false;
                                break;
                        }
                        break;

                    default:
                        return false;
                        break;
                }
                break;
            case 3: #Centro
                switch ($rolPersonal->id) {
                    case 2: #centro
                        return true;
                        break;
                    case 3: #Administrador de centro  
                        return true;
                        break;
                    case 4:
                        return true;
                        break;
                    case 5:
                        return true;
                        break;
                    case 6:
                        return true;
                        break;
                    case 7:
                        return true;
                        break;
                    case 8:
                        return true;
                        break;

                    default:
                        return false;
                        break;
                }

                break;
            case 4: #atleta
                switch ($rolPersonal->id) {
                    case 2: #centro
                        return true;
                        break;
                    case 3: #Administrador de centro  
                        return true;
                        break;
                    case 4:
                        return true;
                        break;
                    case 5:
                        return true;
                        break;
                    case 6:
                        return true;
                        break;
                    case 7:
                        return true;
                        break;
                    case 8:
                        return true;
                        break;

                    default:
                        return false;
                        break;
                }

                break;

            default:
                return false;
                break;
        }
    }

    /**
     * Verifica tu contraseña
     */
    public static function checkPassword($password)
    {
        $auth = auth()->user();
        if (!password_verify($password, $auth->password)) {
            return false;
        }
        return true;
    }

    /**
     * Verifica que tu cuenta no esté bloqueada en el sistema
     */
    public static function checkUserStatus(Usuarios $user)
    {
        switch ($user->id_rol_sistema) {
            case 1: #Root
                if ($user->status) {
                    return true;
                }
                break;

            case 2: #Empresa
                switch ($user->rol_personal->id) {
                    case 1: #Administrador de empresa
                    case 2: #Auxiliar administrador de empresa
                        if ($user->status and $user->empresa->status) {
                            return true;
                        }
                        break;
                }
                break;

            case 3: #Centro
                switch ($user->rol_personal->id) {
                    case 3: #Administrador de centro
                        if ($user->status and $user->empresa->status and isset($user->centro->status) and $user->centro->status) {
                            return true;
                        }
                        break;
                }
                break;
            case 4: #usuario
                switch ($user->rol_personal->id) {
                    case 8: #Administrador de centro
                        if ($user->status) {
                            return true;
                        }
                        break;
                }
                break;
        }

        return false;
    }

    /**
     * Retorna las caracteristicas de tu plan
     */
    public static function getCaracteristicasPlan()
    {
        $caracteristicas_plan = CaracteristicasPlanes::query()
            ->where('id_plan', auth()->user()->empresa->plan_vigente->id_plan)
            ->get();

        return $caracteristicas_plan;
    }

    /**
     * Retorna el número limite de centros para ti [De acuerdo a tu plan como empresa]
     */
    public static function getLimiteCentros()
    {
        $caracteristicas_plan = (new self)->getCaracteristicasPlan();

        $caracteristica_sistema = CaracteristicasSistema::query()
            ->where('uuid', 'serv-centros')
            ->first();

        $caracteristica_plan = $caracteristicas_plan
            ->where('id_caracteristica', $caracteristica_sistema->id)
            ->first();

        $meta = $caracteristica_plan->meta;
        $limite = $meta->where('key', 'Limite')->first();

        return $limite->value;
    }

    /**
     * Verifica si puedes crear más centros 
     */
    public static function canStoreCentro()
    {
        $limite = (new Self)->getLimiteCentros();
        $creados = auth()->user()->empresa->cantidad_centros;

        if ($creados >= $limite) {
            return false;
        }

        return true;
    }

    /**
     * Retorna el número limite de centros para ti [De acuerdo a tu plan como empresa]
     */
    public static function getLimiteAuxAdminEmpresa()
    {
        $caracteristicas_plan = (new self)->getCaracteristicasPlan();

        $caracteristica_sistema = CaracteristicasSistema::query()
            ->where('uuid', 'serv-aux-admin-empresa')
            ->first();

        $caracteristica_plan = $caracteristicas_plan
            ->where('id_caracteristica', $caracteristica_sistema->id)
            ->first();

        if (!$caracteristica_plan) {
            return null;
        }

        $meta = $caracteristica_plan->meta;
        $limite = $meta->where('key', 'Limite')->first();

        return $limite->value;
    }

    /**
     * Verifica si puedes crear más centros 
     */
    public static function canStoreAuxAdminEmpresa()
    {
        $limite = (new Self)->getLimiteAuxAdminEmpresa();
        if ($limite == null) {
            return false;
        }

        $creados = auth()->user()->empresa->cantidad_aux_admin;
        if ($creados >= $limite) {
            return false;
        }

        return true;
    }

    /**
     * Verifica que sea mayor de edad para poder registrarte al sistema como empresa 
     */
    public static function canUseFechaNacimiento($value)
    {

        if ($value >= '2004-01-01') {
            return false;
        }
        return true;
    }


    /**
     * Verifica tenga mas de 8 años cuando se actualiza la información
     */

    public static function patchUseFechaNacimiento($value)
    {

        if ($value >= '2014-01-01') {
            return false;
        }
        return true;
    }

    /**
     * Generar identificador unico para cada usuario
     */

    public static function generarIdentifacador($value)
    {
        mt_srand(time());
        $value = mt_rand(100000, 900000);
        $verificar = Usuarios::query()
            ->where('uuid', $value)
            ->get();
        if ($verificar == true || $verificar == $value) {
            $value = mt_rand(100000, 900000);
            return $value;
        }
        return $value;
    }

    /**
     * Generar codigo de 4 digitos para poder asignar al atleta a un centro
     */

    public static function getCodigoVerificacion($value)
    {
        $arrayCode = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $code = Arr::random($arrayCode, 4);
        $value = (implode($code)); // number(4) "3151"
        return $value;
    }
}
