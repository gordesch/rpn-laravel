<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Week
 *
 * @property int $id
 * @property string $number
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $as_string
 * @property-read mixed $days
 * @property-read mixed $is_adjusted
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Programming[] $programmings
 * @property-read int|null $programmings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Showing[] $showings
 * @property-read int|null $showings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Week whereUpdatedAt($value)
 */
	class Week extends \Eloquent {}
}

namespace App{
/**
 * App\Show
 *
 * @property int $id
 * @property string $slug
 * @property string|null $ticketing_provider_id
 * @property string|null $shows_provider_id
 * @property string $title
 * @property string|null $genre
 * @property int|null $duration_in_seconds
 * @property string|null $country
 * @property int|null $is_local_language
 * @property int|null $year
 * @property string|null $director
 * @property string|null $cast
 * @property string|null $synopsis
 * @property int|null $audience
 * @property int $ignore_missing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $audience_long_string
 * @property-read mixed $audience_short_string
 * @property-read mixed $cast_string
 * @property mixed $duration
 * @property-read mixed $genre_director_country_year_string
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Programming[] $programmings
 * @property-read int|null $programmings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Showing[] $showings
 * @property-read int|null $showings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Video[] $videos
 * @property-read int|null $videos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Week[] $weeks
 * @property-read int|null $weeks_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereAudience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereCast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereDurationInSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereIgnoreMissing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereIsLocalLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereShowsProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereSynopsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereTicketingProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Show whereYear($value)
 */
	class Show extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Video
 *
 * @property int $id
 * @property int $show_id
 * @property int $is_original_version
 * @property string $youtube_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Show $show
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereIsOriginalVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereShowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereYoutubeId($value)
 */
	class Video extends \Eloquent {}
}

namespace App{
/**
 * App\Showing
 *
 * @property int $id
 * @property string $ticketing_provider_id
 * @property int $programming_id
 * @property \Illuminate\Support\Carbon $datetime
 * @property int $preshow_duration_in_seconds
 * @property bool $is_original_version
 * @property bool $is_3d
 * @property int $auditorium_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Programming $programming
 * @property-read \App\Show $show
 * @property-read \App\Week $week
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereAuditoriumNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereIs3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereIsOriginalVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing wherePreshowDurationInSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereProgrammingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereTicketingProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Showing whereUpdatedAt($value)
 */
	class Showing extends \Eloquent {}
}

namespace App{
/**
 * App\Page
 *
 * @property string $lb_content
 * @property-read mixed $lb_raw_content
 * @property-read \VanOns\Laraberg\Models\Content $larabergContent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page query()
 */
	class Page extends \Eloquent {}
}

namespace App{
/**
 * App\Admin
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $username
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App{
/**
 * App\Programming
 *
 * @property int $id
 * @property int $week_id
 * @property int $show_id
 * @property int|null $position
 * @property int|null $is_dubbed_version
 * @property int|null $is_original_version
 * @property int|null $is_2d
 * @property int|null $is_3d
 * @property string|null $custom_showings_infos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $is_adjusted
 * @property-read \App\Show $show
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Showing[] $showings
 * @property-read int|null $showings_count
 * @property-read \App\Week $week
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereCustomShowingsInfos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereIs2d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereIs3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereIsDubbedVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereIsOriginalVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereShowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Programming whereWeekId($value)
 */
	class Programming extends \Eloquent {}
}

