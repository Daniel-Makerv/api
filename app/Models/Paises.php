<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    use HasFactory;

    protected $table = 'paises';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'status'
    ];


    public function provincias()
    {
        return $this->hasMany(Provincias::class, 'id_pais', 'id')->orderBy('nombre');
    }
}
