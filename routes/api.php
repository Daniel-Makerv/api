<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Api, Auth, Resources, Settings};

/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/

Route::get('/', [Auth\AuthController::class, 'response']);

Route::prefix('auth')->group(function () {
    //Requieren que el usuario esté autenticado
    Route::middleware('auth')->group(function () {
        Route::get('user', [Auth\AuthController::class, 'me']);
        Route::post('logout', [Auth\AuthController::class, 'logout']);
    });
    //Requieren que el usuario sea un invitado
    Route::middleware('guest')->group(function () {
        Route::post('login', [Auth\AuthController::class, 'login']);
        Route::post('refresh', [Auth\AuthController::class, 'refresh']);

        Route::prefix('register')->group(function () {
            Route::post('atleta', [Auth\Registro\AtletaController::class, 'registrar']);
            Route::prefix('empresa')->group(function () {
                Route::post('paso-1', [Auth\Registro\EmpresaController::class, 'paso1']);
                Route::post('paso-2', [Auth\Registro\EmpresaController::class, 'paso2']);
            });
        });

        Route::prefix('password')->group(function () {
            Route::post('email', [Auth\ResetPasswordController::class, 'email']);
            Route::get('verify-token/{token}', [Auth\ResetPasswordController::class, 'verifyToken']);
            Route::patch('reset/{token}', [Auth\ResetPasswordController::class, 'reset']);
        });
    });
});

/*
|--------------------------------------------------------------------------
| Rutas de la aplicación
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active'])->group(function () {
    //Rytas para la configuración
    Route::prefix('settings')->group(function () {
        //Configuración de la cuenta de usuario
        Route::prefix('account')->group(function () {
            Route::patch('profile', [Settings\AccountController::class, 'updateProfile']);
            Route::patch('profile/avatar', [Settings\AccountController::class, 'updateAvatarProfile']);
            Route::patch('password', [Settings\AccountController::class, 'updatePassword']);
        });
        //Configuración de la empresa
        Route::middleware('plan')->group(function () {
            Route::prefix('empresa')->middleware(['empresa'])->group(function () {
                Route::patch('contacto', [Settings\EmpresaController::class, 'updateContacto']);
                Route::patch('plan/renovacion-automatica', [Settings\EmpresaController::class, 'renovacionAutomaticaPlan']);
            });
            Route::prefix('centro')->middleware(['centro', 'rol_personal:3|4'])->group(function () {
                Route::patch('contacto', [Settings\CentroController::class, 'updateContacto']);
            });
        });
    });

    //Rutas que requieren que no tengas un plan
    Route::middleware('without_plan')->group(function () {
        Route::get('planes', Api\Plan\PlanesController::class);
        //Rutas para el usuario 'atleta'
        Route::prefix('atleta')->group(function () {
            //rutas atleta
        });
    });
    //Rutas que requieren que tengas un plan
    Route::middleware('plan')->group(function () {
        //Rutas que muestran la información de tu plan
        Route::prefix('plan')->group(function () {
            Route::prefix('limite')->group(function () {
                Route::get('centros', [Api\Plan\LimiteController::class, 'centros']);
                Route::get('auxiliares-administradores-empresa', [Api\Plan\LimiteController::class, 'aux_admin_empresa']);
            });
        });
        //Rutas para el usuario 'empresa'
        Route::prefix('empresa')->middleware('empresa')->group(function () {
            Route::resource('centros', Api\Empresa\CentrosController::class);
            Route::prefix('personal')->group(function () {
                Route::resource('admins', Api\Empresa\PersonalController::class);
                Route::get('roles', [Api\Empresa\PersonalController::class, 'roles']);
                Route::get('centros', [Api\Empresa\PersonalController::class, 'centrosIndex']);
            });
            Route::prefix('planes')->group(function () {
                Route::resource('/', Api\Empresa\PlanesController::class);
                Route::post('adquirir', [Api\Empresa\PlanesController::class, 'buy'])->withoutMiddleware('plan');
            });
        });
        //Rutas para el usuario administrador'centro'
        Route::prefix('centro')->middleware('centro')->group(function () {
            Route::get('atleta/centro', [Api\Centro\AtletaController::class, 'getAtletaSinCentro']);
            Route::patch('atleta/asignar', [Api\Centro\AtletaController::class, 'asignar']); 
            Route::resource('atletas', Api\Centro\AtletaController::class);
            Route::resource('programas', Api\Centro\ProgramaController::class);
            Route::resource('clases', Api\Centro\ClaseController::class);
            Route::resource('salas', Api\Centro\SalaController::class);
            Route::get('stats/atletas', [Api\Centro\AtletaController::class, 'getStatsAtletas']);
            Route::get('stats/clases', [Api\Centro\ClaseController::class, 'getStatsClases']);

            Route::prefix('personal')->group(function () {
                Route::resource('admin', Api\Centro\PersonalController::class);
                Route::get('stats', [Api\Centro\PersonalController::class, 'getStatsPersonal']);
                Route::get('coach', [Api\Centro\PersonalController::class, 'getCoachs']);
                Route::get('roles', [Api\Centro\PersonalController::class, 'roles']);
            });
        });
    });
});

/*
|--------------------------------------------------------------------------
| Rutas de recursos
|--------------------------------------------------------------------------
*/
Route::prefix('resources')->group(function () {
    Route::get('tipos-centros', [Resources\TipoCentroController::class, 'index']);
    Route::prefix('location-cascade')->group(function () {
        Route::get('paises', [Resources\LocationCascadeController::class, 'paises']);
        Route::get('provincias/{id_pais}', [Resources\LocationCascadeController::class, 'provincias']);
        Route::get('ciudades/{id_provincia}', [Resources\LocationCascadeController::class, 'ciudades']);
    });
});
