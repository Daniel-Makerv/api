<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaCaracteristicasPlanes extends Model
{
    use HasFactory;

    protected $table = 'meta_caracteristicas_planes';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_caracteristica_plan',
        'key',
        'value'
    ];
}
