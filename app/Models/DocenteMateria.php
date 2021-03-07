<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $doc_mat_id
 * @property string $doc_id
 * @property string $mat_id
 * @property Docente $docente
 * @property Materium $materium
 */
class DocenteMateria extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'docente_materia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'doc_mat_id';

    /**
     * @var array
     */
    protected $fillable = ['doc_id', 'mat_id'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function docente()
    {
        return $this->belongsTo('App\Models\Docente', 'doc_id', 'doc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materia()
    {
        return $this->belongsTo('App\Models\Materia', 'mat_id', 'mat_id');
    }
}
