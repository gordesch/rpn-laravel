<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programming extends Model
{
    protected $fillable = [
        'week_id',
        'show_id',
        'position',
        'is_dubbed_version',
        'is_original_version',
        'is_2d',
        'is_3d',
        'custom_showings_infos',
    ];

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function showings()
    {
        return $this->hasMany(Showing::class);
    }

    public function week()
    {
        return $this->belongsTo(Week::class);
    }
}
