<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracteristicasPlanes extends Model
{
    use HasFactory;

    protected $table = 'caracteristicas_planes';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_plan',
        'id_caracteristica',
    ];

    protected $with = [
        'caracteristica',
        'meta'
    ];

    public function caracteristica()
    {
        return $this->hasOne(CaracteristicasSistema::class, 'id', 'id_caracteristica');
    }

    public function meta()
    {
        return $this->hasMany(MetaCaracteristicasPlanes::class, 'id_caracteristica_plan', 'id');
    }
}
