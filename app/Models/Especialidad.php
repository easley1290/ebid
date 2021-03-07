<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $esp_id
 * @property string $uni_id
 * @property int $subd_id_estado
 * @property string $esp_nombre
 * @property string $esp_descripcion
 * @property string $esp_mision
 * @property string $esp_vision
 * @property string $esp_objetivo
 * @property Unidad $unidad
 * @property Estudiante[] $estudiantes
 * @property Materium[] $materias
 */
class Especialidad extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'especialidad';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'esp_id';

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
    protected $fillable = ['uni_id', 'subd_id_estado', 'esp_nombre', 'esp_descripcion', 'esp_mision', 'esp_vision', 'esp_objetivo'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidad()
    {
        return $this->belongsTo('App\Models\Unidad', 'uni_id', 'uni_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudiantes()
    {
        return $this->hasMany('App\Models\Estudiante', 'esp_id', 'esp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materias()
    {
        return $this->hasMany('App\Models\Materia', 'esp_id', 'esp_id');
    }
}
