<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $per_id
 * @property int $subd_id_documentacion
 * @property int $subd_id_extension
 * @property int $subd_id_genero
 * @property int $subd_id_estado
 * @property string $per_nombres
 * @property string $per_paterno
 * @property string $per_materno
 * @property string $per_num_documentacion
 * @property string $per_fecha_nac
 * @property string $per_celular
 * @property string $per_telefono
 * @property string $per_correo
 * @property string $per_direccion
 * @property Usuario[] $usuarios
 */
class Persona extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'persona';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'per_id';

    /**
     * @var array
     */
    protected $fillable = ['subd_id_documentacion', 'subd_id_extension', 'subd_id_genero', 'subd_id_estado', 'per_nombres', 'per_paterno', 'per_materno', 'per_num_documentacion', 'per_fecha_nac', 'per_celular', 'per_telefono', 'per_correo', 'per_direccion'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'per_id', 'per_id');
    }
}
