<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model 
{
    use HasFactory;

    protected $table = 'salas';
    protected $primaryKey = 'id';

    protected $fillable = [
    'id_centro',
    'nombre',
    'status',
    ];

    public function Clases()
    {
        return $this->hasOne(Clases::class, 'id', 'id_sala');
    }

}