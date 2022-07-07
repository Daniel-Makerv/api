<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCentros extends Model
{
    
    use HasFactory;

    protected $table = 'tipo_centros';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tipo_centro',
        'status'
    ];

    public function centro(){
        $this->hasOne(Centros::class, 'id','id_tipo_centro');
    }
}
