<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Showing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'ticketing_provider_id',
        'programming_id',
        'datetime',
        'preshow_duration_in_seconds',
        'is_original_version',
        'is_3d',
        'auditorium_number',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string>
     */
    protected $casts = [
        'datetime' => 'datetime',
        'is_original_version' => 'boolean',
        'is_3d' => 'boolean',
    ];

    public function programming(): Relation
    {
        return $this->belongsTo(Programming::class);
    }
}
