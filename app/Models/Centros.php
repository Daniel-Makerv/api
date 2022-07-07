<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centros extends Model
{
    use HasFactory;

    protected $table = 'centros';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_empresa',
        'nombre',
        'email',
        'telefono',
        'id_ciudad',
        'id_tipo_centro',
        'direccion',
        'logo_image',
        'website',
        'fb_page',
        'status'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'pais',
        'provincia',
        'ciudad',
        'tipo_centro',
        
        // 'statusCentro'//cambiar de 0,1 a activo o desactivado
    ];

    /*********************
     * 
     * Accesors
     * 
     *********************/

    public function getIdProvinciaAttribute()
    {
        $ciudad = Ciudades::where('id', $this->id_ciudad)->first();
        $provincia = Provincias::where('id', $ciudad->id_provincia)->first();

        return $provincia->id;
    }

    public function getIdPaisAttribute()
    {
        $provincia = Provincias::where('id', $this->id_provincia)->first();
        $pais = Paises::where('id', $provincia->id_pais)->first();

        return $pais->id;
    }

    public function getPaisAttribute()
    {
        $pais = Paises::where('id', $this->id_pais)->first();
        return $pais->nombre;
    }
    
    public function getIdProvinciasAttribute()
    {
        $provincia = Provincias::where('id', $this->id_provincia)->first();
        $pais = Paises::where('id', $provincia->id_pais)->first();

        return $pais->id;
    }

    public function getProvinciaAttribute()
    {
        $provincia = Provincias::where('id', $this->id_provincia)->first();
        return $provincia->nombre;
    }

    public function getCiudadAttribute()
    {
        $ciudad = Ciudades::where('id', $this->id_ciudad)->first();
        return $ciudad->nombre;
    }

    public function getDireccionCompletaAttribute()
    {
        return "{$this->direccion}, {$this->ciudad}, {$this->provincia}, {$this->pais}";
    }

    public function getTipoCentroAttribute()
    {
        $tipo_centro = TipoCentros::where('id', $this->id_tipo_centro)->first();
        return $tipo_centro->tipo_centro;
    }
    public function getStatusCentroAttribute()
    {
        // $statusCentro = Centros::query()
        //     ->select('status')
        //     ->get();

        //     if ($statusCentro === '1' ) { 
        //         return 'Activado';
        //     }
        //     else{
        //         return 'Desactivado';
        //     }
        //cambiar status de numero a activo o desactivado


    }

    public function getAdminAttribute()
    {
        $relacionAdminCentro = Personal::query()
            ->where('id_empresa', $this->id_empresa)
            ->where('id_centro', $this->id)
            ->where('id_rol_personal', 3) #Administrador de centro
            ->first();

        if (!$relacionAdminCentro) {
            return false;
        }

        $adminCentro = Usuarios::query()
            ->where('id', $relacionAdminCentro->id_usuario)
            ->first();

        if (!$adminCentro) {
            return false;
        }

        return $adminCentro->append('nombre_completo');
    }

    public function getIdAdminAttribute()
    {
        $admin = $this->admin;
        if (!$admin) {
            return false;
        }

        return $admin->id;
    }

    /*********************
     * 
     * Relationships
     * 
     *********************/
    public function Clases()
    {
        return $this->hasMany(Clases::class, 'id_centro', 'id');
    }

    public function Personal()
    {
        return $this->hasMany(Personal::class, 'id_centro', 'id');
    }
    public function tipoCentro()
    {
        return $this->hasOne(tipoCentros::class, 'id_tipo_centro', 'id');
    }

    public function Ciudades()
    {
        return $this->hasMany(Ciudades::class, 'id_ciudad', 'id');
    }
    public function Provincias()
    {
        return $this->hasMany(Provincias::class, 'id_provincia', 'id');
    }
}
