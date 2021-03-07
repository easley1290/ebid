<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $subd_id
 * @property int $subd_dom_id
 * @property string $subd_nombre
 * @property string $subd_descripcion
 * @property Dominio $dominio
 */
class Subdominios extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'subdominios';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'subd_id';

    /**
     * @var array
     */
    protected $fillable = ['subd_dom_id', 'subd_nombre', 'subd_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dominios()
    {
        return $this->belongsTo('App\Models\Dominios', 'subd_dom_id', 'dom_id');
    }
}
