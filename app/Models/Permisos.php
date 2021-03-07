<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $per_id
 * @property int $per_rol_id
 * @property string $per_nombre
 * @property string $per_descripcion
 * @property Role $role
 */
class Permisos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'permisos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'per_id';

    /**
     * @var array
     */
    protected $fillable = ['per_rol_id', 'per_nombre', 'per_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsTo('App\Models\Roles', 'per_rol_id', 'rol_id');
    }
}
