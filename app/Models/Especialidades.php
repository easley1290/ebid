<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $esp_id
 * @property string $esp_nombre
 * @property string $esp_descripcion
 * @property int $esp_subd_estado
 * @property MateriaEstudiante[] $materiaEstudiantes
 */
class Especialidades extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'especialidades';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'esp_id';

    /**
     * @var array
     */
    protected $fillable = ['esp_nombre', 'esp_descripcion', 'esp_subd_estado'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiaEstudiante()
    {
        return $this->hasMany('App\Models\MateriaEstudiante', 'mate_esp_id', 'esp_id');
    }
}
