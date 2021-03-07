<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $sem_id
 * @property int $subd_id_estado
 * @property string $sem_nombre
 * @property string $sem_descripcion
 * @property Estudiante[] $estudiantes
 * @property Materium[] $materias
 */
class Semestre extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'semestre';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'sem_id';

    /**
     * @var array
     */
    protected $fillable = ['subd_id_estado', 'sem_nombre', 'sem_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudiantes()
    {
        return $this->hasMany('App\Models\Estudiante', 'sem_id', 'sem_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materias()
    {
        return $this->hasMany('App\Models\Materia', 'sem_id', 'sem_id');
    }
}
