<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $per_id
 * @property int $rol_id
 * @property string $per_nombre
 * @property string $per_descrip
 * @property Rol $rol
 */
class Permisos extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'per_id';

    /**
     * @var array
     */
    protected $fillable = ['rol_id', 'per_nombre', 'per_descrip'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo('App\Rol', null, 'rol_id');
    }
}
