<?php

namespace App\Models;

use App\Models\Programming;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Showing extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string>
     */
    protected $casts = [
        'datetime' => 'datetime',
        'is_original_version' => 'boolean',
        'is_3d' => 'boolean',
        'preshow_duration_in_seconds' => 'integer',
        'auditorium_number' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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

    public function programming(): Relation
    {
        return $this->belongsTo(Programming::class);
    }
}
