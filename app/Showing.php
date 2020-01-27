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

    protected $casts = [
        'datetime' => 'datetime',
        'is_original_version' => 'boolean',
        'is_3d' => 'boolean',
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
