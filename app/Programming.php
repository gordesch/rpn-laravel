<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Programming extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
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

    public function show(): Relation
    {
        return $this->belongsTo(Show::class);
    }

    public function showings(): Relation
    {
        return $this->hasMany(Showing::class);
    }

    public function week(): Relation
    {
        return $this->belongsTo(Week::class);
    }
}
