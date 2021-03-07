<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cat_id
 * @property string $cat_nombre
 * @property int $subd_id_estado
 * @property int $subd_id_documentacion
 * @property int $subd_id_extension
 * @property int $subd_id_genero
 * @property int $subd_id_periodo
 * @property Docente[] $docentes
 */
class Categoria extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categoria';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cat_id';

    /**
     * @var array
     */
    protected $fillable = ['cat_nombre', 'subd_id_estado', 'subd_id_documentacion', 'subd_id_extension', 'subd_id_genero', 'subd_id_periodo'];

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
        return $this->hasMany('App\Models\Docente', 'cat_id', 'cat_id');
    }
}
