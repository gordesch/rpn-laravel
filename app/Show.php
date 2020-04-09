<?php

namespace App;

use App\Presenters\Poster;
use App\Presenters\ShowPresenter;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Show extends Model implements HasMedia
{
    use InteractsWithMedia;
    use Searchable;
    use ShowPresenter;

    /**
     * The attributes that should be cast.
     *
     * @var array<string>
     */
    protected $casts = [
        'duration_in_seconds' => 'integer',
        'year' => 'integer',
        'audience' => 'integer',
        'is_local_language' => 'boolean',
        'ignore_missing_data' => 'boolean',
        'poster_is_pending' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'genre',
        'duration_in_seconds',
        'country',
        'is_local_language',
        'year',
        'director',
        'cast',
        'synopsis',
        'audience',
        'ticketing_provider_id',
        'shows_provider_id',
    ];

    /**
     * @return array<?string, ?int>
     */
    public function toSearchableArray(): array
    {
        return Arr::only(
            $this->toArray(),
            ['id', 'slug', 'title', 'year', 'director', 'cast', 'updated_at']
        );
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('posters')
            ->singleFile()
            ->registerMediaConversions(function (/*Media $media*/) {
                $this
                    ->addMediaConversion('sm')
                    ->width(34)
                    ->height(46)
                    ->nonQueued();
                $this
                    ->addMediaConversion('sm@2x')
                    ->width(68)
                    ->height(92)
                    ->nonQueued();
            });
    }

    public function getDurationAttribute(): ?CarbonInterval
    {
        if ($this->duration_in_seconds === null) {
            return null;
        }
        return CarbonInterval::seconds($this->duration_in_seconds)->cascade();
    }

    public function setDurationAttribute(CarbonInterval $duration): void
    {
        $this->attributes['duration_in_seconds'] = $duration->totalSeconds;
    }

    public function pages()
    {
        return $this->belongsToMany('App\Page')
            ->withPivot('raw_infos', 'infos', 'date');
    }

    public function programmings(): Relation
    {
        return $this->hasMany(Programming::class);
    }

    public function showings(): Relation
    {
        return $this->hasManyThrough(Showing::class, Programming::class);
    }

    public function videos(): Relation
    {
        return $this->hasMany(Video::class);
    }

    public function weeks(): Relation
    {
        return $this->hasManyThrough(Week::class, Programming::class);
    }
}
