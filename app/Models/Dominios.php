<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $dom_id
 * @property string $dom_nombre
 * @property string $dom_descripcion
 * @property Subdominio[] $subdominios
 */
class Dominios extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    //protected $table = 'dominios';
    protected $table = 'dominios';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'dom_id';

    /**
     * @var array
     */
    protected $fillable = ['dom_nombre', 'dom_descripcion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subdominios()
    {
        return $this->hasMany('App\Models\Subdominios', 'subd_dom_id', 'dom_id');
    }
}
