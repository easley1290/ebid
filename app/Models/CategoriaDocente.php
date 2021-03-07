<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cat_id
 * @property string $cat_nombre
 * @property string $cat_verificacion
 * @property string $cat_tipo_documento
 * @property int $cat_subd_estado
 * @property Docente[] $docentes
 */
class CategoriaDocente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categorias_docente';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cat_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['cat_nombre', 'cat_verificacion', 'cat_tipo_documento', 'cat_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docentes()
    {
        return $this->hasMany('App\Models\Docentes', 'doc_cat_id', 'cat_id');
    }
}
