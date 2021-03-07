<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $usu_id
 * @property int $per_id
 * @property int $rol_id
 * @property string $uni_id
 * @property int $subd_id_estado
 * @property string $usu_codigo_institucional
 * @property string $usu_correo_institucional
 * @property string $usu_contraseña
 * @property string $usu_foto
 * @property string $usu_verificacion_email
 * @property Persona $persona
 * @property Rol $rol
 * @property Unidad $unidad
 * @property Administrativo[] $administrativos
 * @property Docente[] $docentes
 * @property Estudiante[] $estudiantes
 */
class Usuario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usuario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'usu_id';

    /**
     * @var array
     */
    protected $fillable = ['per_id', 'rol_id', 'uni_id', 'subd_id_estado', 'usu_codigo_institucional', 'usu_correo_institucional', 'usu_contraseña', 'usu_foto', 'usu_verificacion_email'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Models\Persona', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo('App\Models\Rol', null, 'rol_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidad()
    {
        return $this->belongsTo('App\Models\Unidad', 'uni_id', 'uni_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administrativos()
    {
        return $this->hasMany('App\Models\Administrativo', 'usu_id', 'usu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docentes()
    {
        return $this->hasMany('App\Models\Docente', 'usu_id', 'usu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudiantes()
    {
        return $this->hasMany('App\Models\Estudiante', 'usu_id', 'usu_id');
    }
}
