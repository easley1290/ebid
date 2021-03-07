<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $matd_id
 * @property string $matd_doc_id
 * @property string $matd_mat_id
 * @property int $matd_subd_estado
 * @property Docente $docente
 * @property Materia $materia
 */
class MateriaDocente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'materias_docente';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'matd_id';

    /**
     * @var array
     */
    protected $fillable = ['matd_doc_id', 'matd_mat_id', 'matd_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function docentes()
    {
        return $this->belongsTo('App\Models\Docentes', 'matd_doc_id', 'doc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materias()
    {
        return $this->belongsTo('App\Models\Materias', 'matd_mat_id', 'mat_id');
    }
}
