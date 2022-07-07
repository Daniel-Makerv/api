<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsoCreditos extends Model
{
    use HasFactory;

    protected $table = 'uso_creditos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_creditos',
        'cantidad',
        'fecha_operacion',
        'operacion'
    ];

    public function Creditos()
    {
        return $this->hasOne(Creditos::class, 'id', 'id_creditos');
    }
}
