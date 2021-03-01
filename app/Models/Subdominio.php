<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $subd_id
 * @property int $dom_id
 * @property string $subd_nombre
 * @property string $subd_descrip
 * @property Dominio $dominio
 */
class Subdominio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'subdominio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'subd_id';

    /**
     * @var array
     */
    protected $fillable = ['dom_id', 'subd_nombre', 'subd_descrip'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dominio()
    {
        return $this->belongsTo('App\Dominio', 'dom_id', 'dom_id');
    }
}
