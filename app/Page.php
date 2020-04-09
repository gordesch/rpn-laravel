<?php

namespace App;

use App\Events\Admin\Website\PageSaved;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'raw_content',
        'content',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => PageSaved::class,
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingLanguage('fr')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function shows()
    {
        return $this->belongsToMany('App\Show')
            ->withPivot('raw_infos', 'infos', 'date');
    }
}
