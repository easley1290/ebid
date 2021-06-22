<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $mate_id
 * @property string $mate_mat_id
 * @property int $mate_esp_id
 * @property int $mate_sem_id
 * @property string $mate_est_id
 * @property int $mate_subd_id
 * @property Especialidade $especialidade
 * @property Estudiante $estudiante
 * @property Materia $materia
 * @property Semestre $semestre
 * @property Nota[] $notas
 */
class MateriaEstudiante extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'materia_estudiante';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'mate_id';

    /**
     * @var array
     */
    protected $fillable = ['mate_mat_id', 'mate_esp_id', 'mate_sem_id', 'mate_est_id', 'mate_subd_id', 'mate_subir_nota'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function especialidades()
    {
        return $this->belongsTo('App\Models\Especialidades', 'mate_esp_id', 'esp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiantes()
    {
        return $this->belongsTo('App\Models\Estudiantes', 'mate_est_id', 'est_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materias()
    {
        return $this->belongsTo('App\Models\Materias', 'mate_mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semestre()
    {
        return $this->belongsTo('App\Models\Semestre', 'mate_sem_id', 'sem_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notas()
    {
        return $this->hasMany('App\Models\Notas', 'nota_mate_id', 'mate_id');
    }
}
