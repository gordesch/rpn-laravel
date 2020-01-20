<?php

namespace App;

use Gordesch\CineCarbonImmutable;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $fillable = [
        'number',
        'start',
        'end'
    ];

    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at'
    ];

    public function setNumberAttribute(string $iso_week_number)
    {
        $this->attributes['number'] = $iso_week_number;
        $week = CineCarbonImmutable::createFromProgrammingWeek($iso_week_number);
        $this->attributes['start'] = $week->startOfWeek();
        $this->attributes['end'] = $week->endOfWeek();
    }

    public function programmings()
    {
        return $this->hasMany(Programming::class);
    }

    public function showings()
    {
        return $this->hasManyThrough(Showing::class, Programming::class);
    }

    public function shows()
    {
        return $this->hasManyThrough(Show::class, Programming::class);
    }
}
