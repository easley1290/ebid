<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rol_id
 * @property string $rol_nombre
 * @property string $rol_descripcion
 * @property Permiso[] $permisos
 */
class Roles extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'roles';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'rol_id';

    /**
     * @var array
     */
    protected $fillable = ['rol_nombre', 'rol_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permisos()
    {
        return $this->hasMany('App\Models\Permisos', 'per_rol_id', 'rol_id');
    }
}
