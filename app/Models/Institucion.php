<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ins_id
 * @property string $ins_nombre
 * @property string $ins_mision
 * @property string $ins_vision
 * @property string $ins_obj
 * @property string $ins_obj_esp1
 * @property string $ins_obj_esp2
 * @property UnidadAcademica[] $unidadAcademicas
 */
class Institucion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'institucion';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ins_id';

    /**
     * @var array
     */
    protected $fillable = ['ins_nombre', 'ins_mision', 'ins_vision', 'ins_obj', 'ins_obj_esp1', 'ins_obj_esp2'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unidadAcademica()
    {
        return $this->hasMany('App\Models\UnidadAcademica', 'ua_ins_id', 'ins_id');
    }
}
