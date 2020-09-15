<?php

namespace App\Models;

use App\Models\Show;
use App\Models\Showing;
use App\Models\Week;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Programming extends Model
{
    use HasFactory;
    /**
     * The attributes that should be cast.
     *
     * @var array<string>
     */
    protected $casts = [
        'is_dubbed_version' => 'boolean',
        'is_original_version' => 'boolean',
        'is_2d' => 'boolean',
        'is_3d' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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

    public function getIsAdjustedAttribute(): bool
    {
        return isset($this->position);
    }

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
