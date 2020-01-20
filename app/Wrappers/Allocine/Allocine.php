<?php

namespace App\Wrappers\Allocine;

use App\Show;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use SimpleXMLElement;

/**
 * Class Allocine
 *
 * Allocine.fr API wrapper, access their movies database
 */
class Allocine
{
    use CastsToShow;

    protected string $endpoint;
    protected string $partner_code;
    protected string $return_type;
    protected Client $client;

    /**
     * Allocine constructor.
     *
     * @param string $return_type xml or json
     */
    public function __construct(string $return_type = 'xml')
    {
        $this->endpoint = config('services.allocine.endpoint');
        $this->partner_code = config('services.allocine.partner_code');
        $this->return_type = $return_type;
        $this->client = new Client();
    }

    /**
     * Search for movies matching a string
     *
     * @param string $title the string to search for
     *
     * @return Collection
     *
     * @throws GuzzleException
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
     * @param string $code the Allocine code to query
     *
     * @return Show
     *
     * @throws GuzzleException
     */
    public static function movie(string $code): Show
    {
        $allocine = new static('xml');
        $query = [
            'code' => $code
        ];
        $response = $allocine->_call('movie', $query);
        return $allocine->toShow($response);
    }

    /**
     * Call the API
     *
     * @param string $service the service to call
     * @param array  $query   the query to perform
     *
     * @return SimpleXMLElement
     *
     * @throws GuzzleException
     */
    private function _call(string $service, array $query): SimpleXMLElement
    {
        $uri = $this->endpoint . $service;
        $options = [
            'query' => [
                'partner' => $this->partner_code,
                'format' => $this->return_type,
            ]
        ];
        foreach ($query as $key => $value) {
            $options['query'] = Arr::add($options['query'], $key, $value);
        }
        $response = $this->client->request('GET', $uri, $options)->getBody();
        return new SimpleXMLElement($response);
    }
}
