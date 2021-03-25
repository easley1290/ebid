<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $est_id
 * @property int $est_per_id
 * @property string $est_comprobante
 * @property int $est_subd_verificacion
 * @property int $est_subd_estado
 * @property Persona $persona
 * @property MateriaEstudiante[] $materiaEstudiantes
 */
class Estudiantes extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estudiantes';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'est_id';

    /**
     * @var array
     */
    protected $fillable = ['est_per_id', 'est_examen_ingreso_fecha', 'est_examen_ingreso_estado', 'est_examen_ingreso_color', 'est_sem_id', 'est_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personas()
    {
        return $this->belongsTo('App\Models\Personas', 'est_per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiaEstudiante()
    {
        return $this->hasMany('App\Models\MateriaEstudiante', 'mate_est_id', 'est_id');
    }
}
