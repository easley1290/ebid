<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $sem_id
 * @property string $sem_nombre
 * @property string $sem_descripcion
 * @property int $sem_subd_estado
 * @property MateriaEstudiante[] $materiaEstudiantes
 * @property Pensum[] $pensums
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
    protected $fillable = ['sem_nombre', 'sem_descripcion', 'sem_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiaEstudiante()
    {
        return $this->hasMany('App\Models\MateriaEstudiante', 'mate_sem_id', 'sem_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pensum()
    {
        return $this->hasMany('App\Models\Pensum', 'pen_sem_id', 'sem_id');
    }
}
