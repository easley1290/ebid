<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $mat_id
 * @property int $sem_id
 * @property string $esp_id
 * @property int $subd_id_estado
 * @property string $mat_nombre
 * @property string $mat_descripcion
 * @property Especialidad $especialidad
 * @property Semestre $semestre
 * @property DocenteMaterium[] $docenteMaterias
 * @property Estudiante[] $estudiantes
 * @property Notum[] $notas
 */
class Materia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'materia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'mat_id';

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
    protected $fillable = ['sem_id', 'esp_id', 'subd_id_estado', 'mat_nombre', 'mat_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function especialidad()
    {
        return $this->belongsTo('App\Models\Especialidad', 'esp_id', 'esp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semestre()
    {
        return $this->belongsTo('App\Models\Semestre', 'sem_id', 'sem_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docenteMaterias()
    {
        return $this->hasMany('App\Models\DocenteMateria', 'mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudiantes()
    {
        return $this->hasMany('App\Estudiante', 'mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notas()
    {
        return $this->hasMany('App\Notum', 'mat_id', 'mat_id');
    }
}
