<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $doc_id
 * @property int $usu_id
 * @property int $cat_id
 * @property int $subd_id_estado
 * @property string $doc_nombre
 * @property string $doc_descrip
 * @property float $doc_salario
 * @property Categorium $categorium
 * @property Usuario $usuario
 * @property DocenteMaterium[] $docenteMaterias
 */
class Docente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'docente';

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
    protected $fillable = ['usu_id', 'cat_id', 'subd_id_estado', 'doc_nombre', 'doc_descrip', 'doc_salario'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'cat_id', 'cat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usu_id', 'usu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docenteMaterias()
    {
        return $this->hasMany('App\Models\DocenteMateria', 'doc_id', 'doc_id');
    }
}
