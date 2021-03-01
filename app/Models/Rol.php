<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rol_id
 * @property string $rol_nombre
 * @property string $rol_descrip
 * @property Permiso[] $permisos
 * @property Usuario[] $usuarios
 */
class Rol extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rol';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'rol_id';

    /**
     * @var array
     */
    protected $fillable = ['rol_nombre', 'rol_descrip'];

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
        return $this->hasMany('App\Permiso', null, 'rol_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany('App\Usuario', null, 'rol_id');
    }
}
