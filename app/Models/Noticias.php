<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $not_id
 * @property string $not_ua_id
 * @property string $not_titulo
 * @property string $not_imagen
 * @property string $not_historia
 * @property int $not_subd_estado
 * @property UnidadAcademica $unidadAcademica
 */
class Noticias extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'noticias';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'not_id';

    /**
     * @var array
     */
    protected $fillable = ['not_ua_id', 'not_titulo', 'not_imagen', 'not_historia', 'not_subd_estado'];

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
        return $this->belongsTo('App\Models\UnidadAcademica', 'not_ua_id', 'ua_id');
    }
}
