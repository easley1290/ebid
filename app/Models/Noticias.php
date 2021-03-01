<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $not_id
 * @property string $uni_id
 * @property string $not_foto
 * @property string $not_titulo
 * @property string $not_descripcion
 * @property int $subd_id_estado
 * @property Unidad $unidad
 */
class Noticias extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'not_id';

    /**
     * @var array
     */
    protected $fillable = ['uni_id', 'not_foto', 'not_titulo', 'not_descripcion', 'subd_id_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidad()
    {
        return $this->belongsTo('App\Unidad', 'uni_id', 'uni_id');
    }
}
