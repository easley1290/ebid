<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $dom_id
 * @property string $dom_nombre
 * @property string $dom_descrip
 * @property Subdominio[] $subdominios
 */
class Dominio extends Model
{   
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    //protected $table = 'dominios';
    protected $table = 'dominio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'dom_id';

    /**
     * @var array
     */
    protected $fillable = ['dom_nombre', 'dom_descrip'];

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
        return $this->hasMany('App\Subdominio', 'dom_id', 'dom_id');
    }
}
