<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
class User extends Authenticatable
{
    /*use HasFactory;
    use Notifiable;
    //use HasRolesAndPermissions;
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

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
    protected $fillable = ['per_ua_id', 'per_nombres', 'per_paterno', 'per_materno', 'per_num_documentacion', 'per_fecha_nacimiento', 'per_telefono', 'name','email', 'per_domicilio', 'per_codigo_institucional', 'per_correo_institucional', 'password', 'per_foto_personal', 'per_verificacion_email', 'per_subd_documentacion', 'per_subd_extension', 'per_subd_genero', 'per_subd_estado'];

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
