<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $gal_id
 * @property string $gal_ua_id
 * @property string $gal_direccion
 * @property string $gal_descripcion
 * @property UnidadAcademica $unidadAcademica
 */
class Galeria extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'galeria';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'gal_id';

    /**
     * @var array
     */
    protected $fillable = ['gal_ua_id', 'gal_direccion', 'gal_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidadAcademica()
    {
        return $this->belongsTo('App\Models\UnidadAcademica', 'gal_ua_id', 'ua_id');
    }
}
