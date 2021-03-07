<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $adm_id
 * @property int $adm_per_id
 * @property string $adm_cargo
 * @property string $adm_area_pertenece
 * @property int $adm_subd_estado
 * @property Persona $persona
 */
class Administrativos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'administrativos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'adm_id';

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
    protected $fillable = ['adm_per_id', 'adm_cargo', 'adm_area_pertenece', 'adm_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personas()
    {
        return $this->belongsTo('App\Models\Personas', 'adm_per_id', 'per_id');
    }
}
