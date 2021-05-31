<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $nota_id
 * @property int $nota_mate_id
 * @property float $nota_practica1
 * @property float $nota_examen1
 * @property float $nota_practica2
 * @property float $nota_examen2
 * @property float $nota_practica3
 * @property float $nota_examen3
 * @property float $nota_final
 * @property MateriaEstudiante $materiaEstudiante
 */
class Notas extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'notas';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nota_id';

    /**
     * @var array
     */
    protected $fillable = ['nota_mate_id', 'nota_final1', 'nota_final2', 'nota_final3', 'nota_final4', 'nota_indicador1', 'nota_indicador2', 'nota_indicador3', 'nota_indicador4', 'nota_final'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materiaEstudiante()
    {
        return $this->belongsTo('App\Models\MateriaEstudiante', 'nota_mate_id', 'mate_id');
    }
}
