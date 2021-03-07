<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $ua_id
 * @property int $ua_ins_id
 * @property string $ua_nombre
 * @property string $ua_direccion
 * @property int $ua_telefono
 * @property int $ua_celular
 * @property string $ua_correo_electronico
 * @property int $ua_subd_estado
 * @property Institucion $institucion
 * @property Carrera[] $carreras
 * @property Noticia[] $noticias
 * @property Persona[] $personas
 */
class UnidadAcademica extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'unidad_academica';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ua_id';

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
    protected $fillable = ['ua_ins_id', 'ua_nombre', 'ua_direccion', 'ua_telefono', 'ua_celular', 'ua_correo_electronico', 'ua_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function institucion()
    {
        return $this->belongsTo('App\Models\Institucion', 'ua_ins_id', 'ins_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carreras()
    {
        return $this->hasMany('App\Models\Carreras', 'car_ua_id', 'ua_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noticias()
    {
        return $this->hasMany('App\Models\Noticias', 'not_ua_id', 'ua_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personas()
    {
        return $this->hasMany('App\Models\Personas', 'per_ua_id', 'ua_id');
    }
}
