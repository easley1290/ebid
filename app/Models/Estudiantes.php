<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $est_id
 * @property int $est_per_id
 * @property string $est_examen_ingreso_fecha
 * @property int $est_examen_ingreso_estado
 * @property string $est_examen_ingreso_color
 * @property int $est_sem_id
 * @property int $est_subd_estado
 * @property string $est_nombre_tutor
 * @property int $est_telefono_tutor
 * @property string $est_domicilio_tutor
 * @property string $est_ocupacion_tutor
 * @property string $est_bachiller
 * @property string $est_cert_nac
 * @property string $est_fot_ci
 * @property string $est_fot_tutor
 * @property string $est_certificaciones
 * @property string $est_experiencia
 * @property Persona $persona
 * @property Comprobante[] $comprobantes
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
    protected $fillable = ['est_per_id', 'est_examen_ingreso_fecha', 'est_examen_ingreso_estado', 'est_examen_ingreso_color', 'est_sem_id', 'est_subd_estado', 'est_nombre_tutor', 'est_telefono_tutor', 'est_domicilio_tutor', 'est_ocupacion_tutor', 'est_bachiller', 'est_cert_nac', 'est_fot_ci', 'est_fot_tutor', 'est_certificaciones', 'est_experiencia'];

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
    public function comprobantes()
    {
        return $this->hasMany('App\Models\Comprobantes', 'com_est_id', 'est_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiaEstudiante()
    {
        return $this->hasMany('App\Models\MateriaEstudiante', 'mate_est_id', 'est_id');
    }
}
