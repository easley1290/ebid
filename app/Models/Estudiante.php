<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $est_id
 * @property int $usu_id
 * @property int $sem_id
 * @property string $esp_id
 * @property string $mat_id
 * @property int $nota_id
 * @property int $subd_id_periodo
 * @property int $subd_id_verificacion
 * @property int $subd_id_estado
 * @property string $est_comprobante
 * @property Especialidad $especialidad
 * @property Materium $materium
 * @property Notum $notum
 * @property Semestre $semestre
 * @property Usuario $usuario
 */
class Estudiante extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estudiante';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'est_id';

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
    protected $fillable = ['usu_id', 'sem_id', 'esp_id', 'mat_id', 'nota_id', 'subd_id_periodo', 'subd_id_verificacion', 'subd_id_estado', 'est_comprobante'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function especialidad()
    {
        return $this->belongsTo('App\Models\Especialidad', 'esp_id', 'esp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materia()
    {
        return $this->belongsTo('App\Models\Materia', 'mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nota()
    {
        return $this->belongsTo('App\Models\Nota', 'nota_id', 'nota_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semestre()
    {
        return $this->belongsTo('App\Models\Semestre', 'sem_id', 'sem_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usu_id', 'usu_id');
    }
}
