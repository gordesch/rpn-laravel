<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'show_id',
        'youtube_id',
        'is_original_version',
    ];

    public function show(): Relation
    {
        return $this->belongsTo(Show::class);
    }
}
