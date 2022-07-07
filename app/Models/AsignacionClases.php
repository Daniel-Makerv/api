<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionClases extends Model
{
    use HasFactory;

    protected $table = 'asignacion_clases';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_clase',
        'id_personal'
    ];

    /**
     * The relationships to append to the model's array form.
     *
     * @var array
     */
    protected $with = [
        'clase',
        'couch'
    ];

    /**
     * Relationships
     */
    public function Clase()
    {
        return $this->hasOne(Clases::class, 'id', 'id_clase');
    }

    public function Couch()
    {
        return $this->hasOne(PersonalCentros::class, 'id', 'id_personal');
    }

}
