<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditos extends Model
{
    use HasFactory;

    protected $table = 'creditos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_centro',
        'id_usuario',
        'pago',
        'cantidad',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function Centro()
    {
        return $this->hasOne(Centros::class, 'id', 'id_centro');
    }

    public function Usuario()
    {
        return $this->hasOne(Usuarios::class, 'id', 'id_usuario');
    }
}
