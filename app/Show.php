<?php

namespace App;

use App\Presenters\ShowPresenter;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Show extends Model implements HasMedia
{
    use InteractsWithMedia;
    use ShowPresenter;

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
        'is_local_language',
        'year',
        'director',
        'cast',
        'synopsis',
        'audience',
        'ticketing_provider_id',
        'shows_provider_id',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('posters')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
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
