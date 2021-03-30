<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $com_id
 * @property int $com_est_id
 * @property string $com_url
 * @property string $com_tipo
 * @property Estudiante $estudiante
 */
class Comprobantes extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'comprobantes';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'com_id';

    /**
     * @var array
     */
    protected $fillable = ['com_est_id', 'com_url', 'com_tipo', 'com_estado', 'com_numero'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiantes()
    {
        return $this->belongsTo('App\Models\Estudiantes', 'com_est_id', 'est_id');
    }
}
