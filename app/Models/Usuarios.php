<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuarios extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'uuid',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'fecha_nacimiento',
        'email',
        'password',
        'id_rol_sistema',
        'avatar',
        'sexo',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d/m/Y',
    ];

    /*********************
     * 
     * Accesors
     * 
     *********************/
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    public function getFotoUrlAttribute()
    {
        return vsprintf('https://www.gravatar.com/avatar/%s.jpg?s=200&d=%s', [
            md5(strtolower($this->email)),
            $this->nombre ? urlencode("https://ui-avatars.com/api/{$this->nombre}") : 'mp',
        ]);
    }

    public function getEmpresaAttribute()
    {
        if ($this->id_rol_sistema == 2 OR $this->id_rol_sistema == 3 OR $this->id_rol_sistema == 4){ 
            $personal = Personal::query()
                                ->where('id_usuario', $this->id)
                                ->first();
            if ($personal) {
                $res = $personal->empresa;
            } else {
                $res = null;
            }
        } else {
            $res = null;
        }

        return $res;
    }
    
    public function getCentroAttribute()
    {
        if($this->rol_sistema->id == 3){
            $personal = Personal::query()
                              ->where('id_usuario', $this->id)
                              ->first();
            if ($personal){
                if ($personal->centro) {
                    $res = $personal->centro;
                } else {
                    $res = [
                        'nombre' => 'No asignado'
                    ];
                }
            } else {
                $res = [
                    'nombre' => 'Error! #DBU'
                ];
            }
        } else {
            $res = [
                'nombre' => 'No Aplica'
            ];
        }

        return $res;
    }

    public function getRolPersonalAttribute()
    {
        if ($this->id_rol_sistema == 2 OR $this->id_rol_sistema == 3 OR $this->id_rol_sistema == 4){
            $personal = Personal::query()
                                ->where('id_usuario', $this->id)
                                ->first();

            if ($personal) {
                $res = $personal->rol_personal;
            } else {
                $res = null;
            }
        } else {
            $res = null;
        }

        return $res;
    }

    public function getCreditosAttribute()
    {
        if ($this->rol_sistema->id == 3){
            $creditos = Creditos::query()
                                ->where('id_usuario', $this->id)
                                ->get();

            if ($creditos->isNotEmpty()){
                
            } else {
                $res = 0;
            }
        } else {
            $res = null;
        }

        return $res;
    }


    /*********************
     * 
     * Relationships
     * 
     *********************/
    public function rol_sistema()
    {
        return $this->hasOne(RolesSistema::class, 'id', 'id_rol_sistema');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function Atletas()
    {
        return $this->hasOne(Atleta::class, 'id_usuario', 'id');
    }

}
