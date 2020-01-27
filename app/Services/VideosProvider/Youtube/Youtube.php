<?php

namespace App\Services\VideosProvider\Youtube;

use App\Services\VideosProvider\VideosProviderInterface;
use App\Show;
use Illuminate\Support\Collection;
use Alaouy\Youtube\Facades\Youtube as YoutubePackage;

class Youtube implements VideosProviderInterface
{
    public static function search(Show $show): Collection
    {
        $results = new Collection;
        $results->put(
            'original_version',
            self::_searchTrailers($show->title, true)
        );
        $results->put(
            'dubbed_version',
            self::_searchTrailers($show->title, false)
        );
        return $results;
    }

    private static function _searchTrailers(
        string $title,
        bool $is_original_version
    ): Collection
    {
        $version
            = $is_original_version
            ? 'vost '
            : 'vf';

        $params = [
            'q'               => "bande annonce {$version} {$title}",
            'type'            => 'video',
            'part'            => 'id, snippet',
            'maxResults'      => 5,
            'videoEmbeddable' => 'true',
            'videoSyndicated' => 'true',
        ];

        return new Collection(YoutubePackage::searchAdvanced($params));
    }

}
