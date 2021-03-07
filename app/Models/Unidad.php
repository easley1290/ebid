<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $uni_id
 * @property string $uni_nombre
 * @property string $uni_descripcion
 * @property string $uni_vision
 * @property string $uni_mision
 * @property string $uni_objetivo
 * @property int $subd_id_estado
 * @property Especialidad[] $especialidads
 * @property Noticia[] $noticias
 * @property Usuario[] $usuarios
 */
class Unidad extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'unidad';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'uni_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['uni_nombre', 'uni_descripcion', 'uni_vision', 'uni_mision', 'uni_objetivo', 'subd_id_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function especialidads()
    {
        return $this->hasMany('App\Models\Especialidad', 'uni_id', 'uni_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noticias()
    {
        return $this->hasMany('App\Models\Noticia', 'uni_id', 'uni_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany('App\Models\Usuario', 'uni_id', 'uni_id');
    }
}
