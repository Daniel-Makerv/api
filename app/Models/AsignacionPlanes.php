<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionPlanes extends Model
{
    use HasFactory;

    protected $table = 'asignacion_planes';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_empresa',
        'id_plan',
        'pago',
        'fecha_inicio',
        'fecha_fin',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_inicio' => 'datetime:d-m-Y',
        'fecha_fin'    => 'datetime:d-m-Y'
    ];

    
    protected $with = [
        'plan'
    ];

    /**
     * Relationships
     */
    public function Empresa()
    {
        return $this->hasOne(Empresas::class, 'id', 'id_empresa');
    }

    public function Plan()
    {
        return $this->hasOne(Planes::class, 'id', 'id_plan');
    }
}
