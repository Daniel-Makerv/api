<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_empresa',
        'id_centro',
        'id_usuario',
        'id_rol_personal',
        'status',
        'avatar'
    ];
    public function getImageAtributes($value){
        return Storage::url("fotos_perfiles/". $value);
    }


    public function Empresa()
    {
        return $this->hasOne(Empresas::class, 'id', 'id_empresa');
    }

    public function Centro()
    {
        return $this->hasOne(Centros::class, 'id', 'id_centro');
    }

    public function Usuarios()
    {
        return $this->hasOne(Usuarios::class, 'id', 'id_usuario');
    }
    public function Atletas()
    {
        return $this->hasOne(Atleta::class, 'id_usuario', 'id');
    }

    public function Rol_Personal()
    {
        return $this->hasOne(RolesPersonal::class, 'id', 'id_rol_personal');
    }
    public function Clases()
    {
        return $this->hasOne(Clases::class, 'id_coach', 'id');
    }
}
