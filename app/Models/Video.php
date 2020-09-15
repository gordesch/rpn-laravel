<?php

namespace App\Models;

use App\Models\Show;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string>
     */
    protected $casts = [
        'is_original_version' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'show_id',
        'youtube_id',
        'is_original_version',
    ];

    public function show(): Relation
    {
        return $this->belongsTo(Show::class);
    }
}
