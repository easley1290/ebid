<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $doc_id
 * @property int $doc_per_id
 * @property int $doc_cat_id
 * @property float $doc_salario
 * @property string $doc_cargo
 * @property string $doc_descripcion
 * @property CategoriasDocente $categoriasDocente
 * @property Persona $persona
 * @property MateriasDocente[] $materiasDocentes
 */
class Docentes extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'docentes';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'doc_id';

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
    protected $fillable = ['doc_per_id', 'doc_cat_id', 'doc_salario', 'doc_cargo', 'doc_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriaDocente()
    {
        return $this->belongsTo('App\Models\CategoriaDocente', 'doc_cat_id', 'cat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personas()
    {
        return $this->belongsTo('App\Models\Personas', 'doc_per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiaDocente()
    {
        return $this->hasMany('App\Models\MateriaDocente', 'matd_doc_id', 'doc_id');
    }
}
