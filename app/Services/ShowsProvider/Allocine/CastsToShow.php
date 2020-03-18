<?php

namespace App\Services\ShowsProvider\Allocine;

use App\Show;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;
use SimpleXMLElement;


/**
 * Trait CastsToShow
 *
 * Casts a response from the API to an App\Show
 */
Trait CastsToShow
{
    /**
     * Returns a show
     *
     * @param SimpleXMLElement $allocine_show the element to cast
     *
     * @return Show
     */
    protected function toShow(SimpleXMLElement $allocine_show): Show
    {
        $show = new Show;

        $show->shows_provider_id = (string) $allocine_show['code'];

        $match = Show::select('id', 'shows_provider_id')->where(
            'shows_provider_id',
            $show->shows_provider_id
        )->first();

        if (!empty($match)) {
            $show->id = $match->id;
            $show->exists = true;
        } else {
            $show->id = null;
            $show->exists = false; // Already set
        }

        $show->title
            = isset($allocine_show->title)
            ? (string) $allocine_show->title
            : (string) $allocine_show->originalTitle;

        $show->slug = Str::slug($show->title);

        $show->poster_url
            = isset($allocine_show->poster['href'])
            ? (string) $allocine_show->poster['href']
            : null;

        if (isset($allocine_show->genreList->genre)) {
            if (count($allocine_show->genreList->genre) === 1) {
                $show->genre = (string) $allocine_show->genreList->genre[0];
            } else {
                $show->genre
                    = (string) implode(
                    ', ',
                    Arr::flatten($allocine_show->genreList->genre)
                );
            }
        } else {
            $show->genre = null;
        }

        $show->duration_in_seconds
            = isset($allocine_show->runtime)
            ? (int) $allocine_show->runtime
            : null;

        $show->country
            = isset($allocine_show->nationalityList->nationality[0])
            ?  (string) $allocine_show->nationalityList->nationality[0]
            : null;

        $show->is_local_language
            = isset($allocine_show->languageList->language[0])
            ? (
                (string) $allocine_show->languageList->language[0] === config('app.shows_db.locale_language')
                ? true
                : false
            ): null;

        $show->year
            = isset($allocine_show->productionYear)
            ? (int) $allocine_show->productionYear
            : null;

        $show->release_date
            = $allocine_show->release->releaseDate
            ? Carbon::parse(
                $allocine_show->release->releaseDate
            )->format('d/m/Y')
            : null;

        $show->director
            = isset($allocine_show->castingShort->directors)
            ? (string) $allocine_show->castingShort->directors
            : null;

        $show->cast
            = isset($allocine_show->castingShort->actors)
            ? (string) $allocine_show->castingShort->actors
            : null;

        $synopsis = null;
        if ($allocine_show->synopsis) {
            $synopsis = $allocine_show->synopsis->asXML();
        } elseif ($allocine_show->synopsisShort) {
            $allocine_show->synopsisShort->asXML();
        }
        if ($synopsis) {
            $synopsis = strip_tags($synopsis);
            $synopsis = preg_replace('/\s\s+/u', ' ', $synopsis);
            $show->synopsis = trim($synopsis);
        } else {
            $show->synopsis = null;
        }


        if (isset($allocine_show->movieCertificate->certificate)) {
            $audience = $allocine_show->movieCertificate->certificate;
            if (Str::contains($audience, '18')) {
                $show->audience = '18';
            } elseif (Str::contains($audience, '16')) {
                $show->audience = '16';
            } elseif (Str::contains($audience, '12')) {
                $show->audience = '12';
            } elseif (Str::contains($audience, 'Avertissement')) {
                $show->audience = '0';
            } elseif (Str::contains($audience, 'partir de')) {
                $show->audience = trim(mb_substr($audience, 12, 2));
            }
        } else {
            $show->audience = null;
        }
        return $show;
    }
}
