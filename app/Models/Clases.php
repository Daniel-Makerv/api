<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
    use HasFactory;

    protected $table = 'clases';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_centro',
        'id_programa',
        'id_coach',
        'id_sala',
        'id_centro',
        'limite_reservas',
        'contar_reserva',
        'hora_inicio',
        'hora_fin',
        'restringir_disp',
        'status'
    ];

    /**
     * The relationships to append to the model's array form.
     *
     * @var array
     */
    protected $with = [
        'centro',
    ];

    /*********************
     * 
     * Accesors
     * 
     *********************/
    public function getProgramaAttribute()
    {
        $getprograma = Programas::query()
        ->where('id', '=',$this->programas->id)
        ->first();
        return $getprograma->nombre;
    }
    public function getCoachAttribute()
    {
        $getpersonal = Personal::query()
        ->where('id', '=',$this->personal->id)
        ->first();

        $getusuario = Usuarios::query()
        ->where('id', '=', $getpersonal->id_usuario)
        ->first();
        return $getusuario->nombre . ' ' . $getusuario->apellido_paterno . ' ' . $getusuario->apellido_materno;
    }

    public function getDiasClasesAttribute()
    {
        $getdias = 'Lunes, Miercoles, Jueves';
        return $getdias;
    }

    public function getSalaAttribute()
    {
        $getSala = Sala::query()
        ->where('id', '=',$this->salas->id)
        ->first();
        return $getSala->nombre;
    }

    /**
     * Relationships
     */
    public function Clase()
    {
        return $this->hasOne(Clases::class, 'id', 'id_clase');
    }
    public function Salas()
    {
        return $this->hasOne(Sala::class, 'id', 'id_sala');
    }
    public function Dias()
    {
        return $this->hasMany(DiasClases::class, 'id_clase', 'id');
    }
    public function Centro()
    {
        return $this->hasOne(Centros::class, 'id', 'id_centro');
    }

    public function Programas()
    {
        return $this->hasOne(Programas::class, 'id', 'id_programa');
    }

    public function Personal()
    {
        return $this->hasOne(Personal::class, 'id', 'id_coach');
    }

}
