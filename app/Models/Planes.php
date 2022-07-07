<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    use HasFactory;

    protected $table = 'planes';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'imagen',
        'nombre',
        'uuid',
        'descripcion',
        'precio',
        'calificacion'
    ];

    protected $with = [
        'caracteristicas'
    ];

    public function Caracteristicas()
    {
        return $this->hasMany(CaracteristicasPlanes::class, 'id_plan', 'id');
    }

}
