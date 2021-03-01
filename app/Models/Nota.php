<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $nota_id
 * @property string $mat_id
 * @property float $nota_prac_1
 * @property float $nota_exam_1
 * @property float $nota_prac_2
 * @property float $nota_exam_2
 * @property float $nota_prac_3
 * @property float $nota_exam_3
 * @property Materium $materium
 * @property Estudiante[] $estudiantes
 */
class Nota extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'nota';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nota_id';

    /**
     * @var array
     */
    protected $fillable = ['mat_id', 'nota_prac_1', 'nota_exam_1', 'nota_prac_2', 'nota_exam_2', 'nota_prac_3', 'nota_exam_3'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materium()
    {
        return $this->belongsTo('App\Materium', 'mat_id', 'mat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudiantes()
    {
        return $this->hasMany('App\Estudiante', 'nota_id', 'nota_id');
    }
}
