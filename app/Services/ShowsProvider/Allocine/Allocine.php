<?php

namespace App\Services\ShowsProvider\Allocine;

use App\Show;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;
use App\Services\ShowsProvider\ShowsProviderInterface;

/**
 * Class Allocine
 *
 * Allocine.fr API wrapper, access their movies database
 */
class Allocine implements ShowsProviderInterface
{
    use CastsToShow;

    protected array $config;

    /**
     * Allocine constructor.
     *
     * @param string $response_return_type xml or json
     */
    public function __construct(string $response_return_type = 'xml')
    {
        $this->config['endpoint'] = config('services.allocine.endpoint');
        $this->config['partner_code'] = config('services.allocine.partner_code');
        $this->config['response_return_type'] = $response_return_type;
    }

    /**
     * Search for movies matching a string
     *
     * @param  string  $title  the string to search for
     *
     * @return Collection
     *
     * @throws RequestException
     */
    public static function search(string $title): Collection
    {
        $allocine = new static('xml');
        $query = ['q' => $title];
        $response = $allocine->_call('search', $query);
        $shows = new Collection;
        foreach ($response->movie as $movie) {
            $shows->push($allocine->toShow($movie));
        }
        return $shows;
    }

    /**
     * Get a movie
     *
     * @param  string  $code  the Allocine code to query
     *
     * @return Show
     *
     * @throws RequestException
     */
    public static function show(string $code): Show
    {
        $allocine = new static('xml');
        $query = [
            'code' => $code
        ];
        $response = $allocine->_call('movie', $query);
        return $allocine->toShow($response);
    }

    /**
     * Synchronize a local Show with its Allocine counterpart
     *
     * @param  Show  $app_show  our local Show
     *
     * @return Show
     *
     * @throws RequestException
     */
    static public function synchronize(Show $app_show): Show
    {
        $allocine_show = self::show($app_show->shows_provider_id);
        $merged = array_merge($app_show->getAttributes(), $allocine_show->getAttributes());
        return $app_show->setRawAttributes($merged);
    }

    /**
     * Call the API
     *
     * @param  string  $service  the service to call
     * @param  array  $query  the query to perform
     *
     * @return SimpleXMLElement
     *
     * @throws RequestException
     */
    private function _call(string $service, array $query): SimpleXMLElement
    {
        $uri = $this->config['endpoint'] . $service;
        $query = array_merge($query, [
            'partner' => $this->config['partner_code']
        ]);
        $response = Http::get($uri, $query)->throw();
        return new SimpleXMLElement($response->body());
    }
}
