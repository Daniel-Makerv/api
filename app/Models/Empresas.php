<?php

namespace App\Models;

use App\Models\Paises;
use App\Models\Ciudades;
use App\Models\Provincias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Centros;
use App\Models\Personal;

class Empresas extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre_fiscal',
        'id_fiscal',
        'email',
        'telefono',
        'id_ciudad',
        'direccion_legal',
        'renovacion_automatica_plan',
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
        'plan_vigente',
        'cantidad_centros',
        'cantidad_aux_admin'
    ];

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
        return "{$this->direccion_legal}, {$this->ciudad}, {$this->provincia}, {$this->pais}";
    }

    public function getUltimoPlanAttribute()
    {
        $ultimo_plan = $this->PlanesContratados()->latest('created_at')->first();
        if ($ultimo_plan) {
            return $ultimo_plan;
        } else {
            return null;
        }
    }

    public function getPlanVigenteAttribute()
    {
        $ultimo_plan = $this->ultimo_plan;
        if ($ultimo_plan != null) {
            if ($ultimo_plan->fecha_fin > now()) {
                return $ultimo_plan;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getCentrosAttribute()
    {
        $centros = Centros::query()
            ->where('id_empresa', $this->id)
            ->get();

        return $centros;
    }

    public function getCantidadCentrosAttribute()
    {
        $cantidad  =  $this->centros->count();
        return $cantidad;
    }

    public function getCantidadAuxAdminAttribute()
    {
        $cantidad = Personal::query()
            ->where('id_empresa', auth()->user()->empresa->id)
            ->where('id_rol_personal', 2) #Auxiliar Administrador de empresa
            ->get();

        return $cantidad->count();
    }

    public function PlanesContratados()
    {
        return $this->hasMany(AsignacionPlanes::class, 'id_empresa', 'id');
    }
}
