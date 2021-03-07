<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $per_id
 * @property string $per_ua_id
 * @property string $per_nombres
 * @property string $per_paterno
 * @property string $per_materno
 * @property int $per_num_documentacion
 * @property string $per_fecha_nacimiento
 * @property int $per_telefono
 * @property string $per_correo_personal
 * @property string $per_domicilio
 * @property string $per_codigo_institucional
 * @property string $per_correo_institucional
 * @property string $per_contrasenia
 * @property string $per_foto_personal
 * @property string $per_verificacion_email
 * @property int $per_subd_documentacion
 * @property int $per_subd_extension
 * @property int $per_subd_genero
 * @property int $per_subd_estado
 * @property UnidadAcademica $unidadAcademica
 * @property Administrativo[] $administrativos
 * @property Docente[] $docentes
 * @property Estudiante[] $estudiantes
 */
class Personas extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'personas';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'per_id';

    /**
     * @var array
     */
    protected $fillable = ['per_ua_id', 'per_nombres', 'per_paterno', 'per_materno', 'per_num_documentacion', 'per_fecha_nacimiento', 'per_telefono', 'per_correo_personal', 'per_domicilio', 'per_codigo_institucional', 'per_correo_institucional', 'per_contrasenia', 'per_foto_personal', 'per_verificacion_email', 'per_subd_documentacion', 'per_subd_extension', 'per_subd_genero', 'per_subd_estado'];

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
        return $this->belongsTo('App\Models\UnidadAcademica', 'per_ua_id', 'ua_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administrativos()
    {
        return $this->hasMany('App\Models\Administrativos', 'adm_per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docentes()
    {
        return $this->hasMany('App\Models\Docentes', 'doc_per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudiantes()
    {
        return $this->hasMany('App\Models\Estudiantes', 'est_per_id', 'per_id');
    }
}
