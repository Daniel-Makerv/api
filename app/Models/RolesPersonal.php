<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesPersonal extends Model
{
    use HasFactory;

    protected $table = 'roles_personal';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'id_rol_sistema'
    ];

    protected $with = [
        'tabs'
    ];

    public function Tabs()
    {
        return $this->hasMany(Tabs::class, 'id_rol_personal', 'id')->orderBy('id');
    }
}
