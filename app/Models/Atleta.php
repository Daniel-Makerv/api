<?php

namespace App\Models;

use Database\Factories\RolesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atleta extends Model
{
    use HasFactory;

    protected $table = 'atletas';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id_usuario',
        'nickname',
        'codigo_asignar',
        'altura',
        'peso',
        'rfc',
        'codigo_postal',
        'password',
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */

    public function Usuarios()
    {
        return $this->hasOne(Usuarios::class, 'id', 'id_usuario');
    }

}
