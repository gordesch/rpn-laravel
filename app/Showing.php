<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Showing extends Model
{
    protected $fillable = [
        'ticketing_provider_id',
        'programming_id',
        'datetime',
        'preshow_duration_in_seconds',
        'is_original_version',
        'is_3d',
        'auditorium_number',
    ];

    public function programming()
    {
        return $this->belongsTo(Programming::class);
    }

    public function show()
    {
        return $this->hasOneThrough(Show::class, Programming::class);
    }

    public function week()
    {
        return $this->hasOneThrough(Week::class, Programming::class);
    }
}
