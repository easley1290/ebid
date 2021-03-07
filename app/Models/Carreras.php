<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $car_id
 * @property string $car_ua_id
 * @property string $car_nombre
 * @property string $car_descripcion
 * @property string $car_fecha_creacion
 * @property int $car_subd_estado
 * @property UnidadAcademica $unidadAcademica
 * @property Pensum[] $pensums
 */
class Carreras extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'carreras';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'car_id';

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
    protected $fillable = ['car_ua_id', 'car_nombre', 'car_descripcion', 'car_fecha_creacion', 'car_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidadAcademica()
    {
        return $this->belongsTo('App\Models\UnidadAcademica', 'car_ua_id', 'ua_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pensum()
    {
        return $this->hasMany('App\Models\Pensum', 'pen_car_id', 'car_id');
    }
}
