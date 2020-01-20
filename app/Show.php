<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'genre',
        'duration_in_seconds',
        'country',
        'year',
        'director',
        'cast',
        'synopsis',
        'audience',
    ];

    public function getDurationAttribute(): CarbonInterval
    {
        return CarbonInterval::seconds($this->duration_in_seconds)->cascade();
    }

    public function setDurationAttribute(CarbonInterval $duration): void
    {
        $this->attributes['duration_in_seconds'] = $duration->totalSeconds;
    }

    public function programmings()
    {
        return $this->hasMany(Programming::class);
    }

    public function showings()
    {
        return $this->hasManyThrough(Showing::class, Programming::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function weeks()
    {
        return $this->hasManyThrough(Week::class, Programming::class);
    }
}
