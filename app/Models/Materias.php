<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $mat_id
 * @property string $mat_nombre
 * @property string $mat_descripcion
 * @property int $mat_subd_estado
 * @property MateriaEstudiante[] $materiaEstudiantes
 * @property MateriasDocente[] $materiasDocentes
 * @property Pensum[] $pensums
 */
class Materias extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'materias';

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
    protected $fillable = ['mat_nombre', 'mat_descripcion', 'mat_subd_estado'];

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
        return $this->hasMany('App\Models\MateriaEstudiante', 'mate_mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiaDocente()
    {
        return $this->hasMany('App\Models\MateriaDocente', 'matd_mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pensum()
    {
        return $this->hasMany('App\Models\Pensum', 'pen_mat_id', 'mat_id');
    }
}
