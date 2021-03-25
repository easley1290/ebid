<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pen_id
 * @property string $pen_car_id
 * @property string $pen_mat_id
 * @property int $pen_sem_id
 * @property int $pen_subd_estado
 * @property Carrera $carrera
 * @property Materia $materia
 * @property Semestre $semestre
 */
class Pensum extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pensum';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pen_id';

    /**
     * @var array
     */
    protected $fillable = ['pen_esp_id', 'pen_mat_id', 'pen_sem_id', 'pen_subd_estado'];

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
        return $this->belongsTo('App\Models\Especialidades', 'pen_esp_id', 'esp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materia()
    {
        return $this->belongsTo('App\Models\Materias', 'pen_mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semestre()
    {
        return $this->belongsTo('App\Models\Semestre', 'pen_sem_id', 'sem_id');
    }
}
