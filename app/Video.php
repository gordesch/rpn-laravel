<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'show_id',
        'youtube_id',
        'is_original_version'
    ];

    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
