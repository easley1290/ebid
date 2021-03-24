<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $exa_id
 * @property int $exa_est_id
 * @property string $exa_fecha
 * @property int $exa_estado
 * @property Estudiante $estudiante
 */
class ExamenIngreso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'examen_ingreso';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'exa_id';

    /**
     * @var array
     */
    protected $fillable = ['exa_per_id', 'exa_fecha', 'exa_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiantes()
    {
        return $this->belongsTo('App\Models\Personas', 'exa_per_id', 'per_id');
    }
}
