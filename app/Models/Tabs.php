<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabs extends Model
{
    use HasFactory;

    protected $table = 'tabs';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_rol_personal',
        'icon',
        'label',
        'route',
        'visible',
        'status'
    ];

    public function Rol_Personal()
    {
        $this->hasOne(RolesPersonal::class, 'id', 'id_rol_personal');
    }
}
