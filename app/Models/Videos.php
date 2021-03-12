<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $vid_id
 * @property string $vid_ua_id
 * @property string $vid_titulo
 * @property string $vid_url
 * @property int $vid_subd_estado
 * @property UnidadAcademica $unidadAcademica
 */
class Videos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'videos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'vid_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['vid_ua_id', 'vid_titulo', 'vid_url', 'vid_subd_estado'];

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
        return $this->belongsTo('App\Models\UnidadAcademica', 'vid_ua_id', 'ua_id');
    }
}
