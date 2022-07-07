<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
    use HasFactory;

    protected $table = 'provincias';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_pais',
        'nombre',
        'status'
    ];


    public function pais()
    {
        $this->hasOne(Paises::class, 'id', 'id_pais');
    }

    public function ciudades()
    {
        return $this->hasMany(Ciudades::class, 'id_provincia', 'id')->orderBy('nombre');
    }

    // public function Centro()
    // {
    //     $this->hasOne(Centros::class, 'id', 'id_provincia')->orderBy('nombre');
    // }
}
