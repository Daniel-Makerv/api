<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasClases extends Model
{
    protected $table = 'dias_clases';
    protected $primaryKey = 'id';

    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_clase',
        'dia_semana',
    ];

    protected $with = [
        'clases',
    ];

    public function Clases()
    {
        return $this->hasMany(Clases::class, 'id', 'id_clase');
    }

}
