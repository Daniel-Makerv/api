<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use HasFactory;

    protected $table = 'ciudades';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_provincia',
        'nombre',
        'status'
    ];

    public function Provincia()
    {
        $this->hasOne(Provincias::class, 'id', 'id_provincia')->orderBy('nombre');
    }
    public function Centros()
    {
        $this->hasOne(Centros::class, 'id_ciudad', 'id')->orderBy('nombre');
    }
}
