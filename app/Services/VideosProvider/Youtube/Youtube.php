<?php

namespace App\Services\VideosProvider\Youtube;

use App\Services\VideosProvider\VideosProvider;
use App\Models\Show;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Youtube implements VideosProvider
{
    /**
     * @var array<string>
     */
    protected array $config;

    public function __construct()
    {
        $this->config['endpoint'] = config('services.youtube.endpoint');
        $this->config['api_key'] = config('services.youtube.api_key');
    }

    /**
     * Search Youtube for trailers in dubbed and original version
     *
     * @param  Show  $show
     *
     * @return Collection
     *
     * @throws RequestException
     */
    public static function search(Show $show): Collection
    {
        $results = new Collection();
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

    /**
     * Search Youtube for trailers of a movie in dubbed or original language
     *
     * @param  string  $title
     * @param  bool  $is_original_version
     *
     * @return Collection
     *
     * @throws RequestException
     */
    private static function _searchTrailers(
        string $title,
        bool $is_original_version
    ): Collection {
        $version
            = $is_original_version
            ? 'vost'
            : 'vf';

        $query = [
            'q' => "bande annonce {$version} {$title}",
            'type' => 'video',
            'part' => 'id, snippet',
            'maxResults' => '5',
            'videoEmbeddable' => 'true',
            'videoSyndicated' => 'true',
        ];

        $youtube = new static();
        $results = $youtube->_call($query);

        return new Collection($results->items);
    }

    /**
     * Call the Youtube API
     *
     * @param  array<string>  $query
     *
     * @return mixed
     *
     * @throws RequestException
     */
    private function _call(array $query)
    {
        $uri = $this->config['endpoint'];
        $query = array_merge($query, [
            'key' => $this->config['api_key'],
        ]);
        $response = Http::get($uri, $query)->throw();
        return json_decode($response->body());
    }
}
