<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    /**
     * Участник фотоконкурса
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * Фотоконкурс
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photocontest()
    {
        return $this->belongsTo(Photocontest::class);
    }
}
