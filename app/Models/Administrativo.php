<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $adm_id
 * @property int $usu_id
 * @property int $subd_id_estado
 * @property string $adm_nombre
 * @property string $adm_descrip
 * @property Usuario $usuario
 */
class Administrativo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'administrativo';

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
    protected $fillable = ['usu_id', 'subd_id_estado', 'adm_nombre', 'adm_descrip'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usu_id', 'usu_id');
    }
}
