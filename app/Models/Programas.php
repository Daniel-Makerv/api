<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    use HasFactory;

    protected $table = 'programas';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'id_centro',
        'permitir_mas_reserva',
        'cancelar_fuera_plazo',
        'reservar_desde',
        'opcion_reservar_desde',
        'periodo_reservar_desde',
        'reservar_hasta',
        'opcion_reservar_hasta',
        'periodo_reservar_hasta',
        'cancelar_reserva',
        'opcion_cancelar_reserva',
        'periodo_cancelar_reserva',
        'color'
    ];

    public function Clases()
    {
        return $this->hasOne(Clases::class, 'id_programa', 'id');
    }

    

}
