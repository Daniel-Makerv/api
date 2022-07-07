<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioClases extends Model
{
    use HasFactory;

    protected $table = 'horario_clases';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_asignacion_clase',
        'fecha',
        'hora_inicio',
        'hora_fin'
    ];
}
