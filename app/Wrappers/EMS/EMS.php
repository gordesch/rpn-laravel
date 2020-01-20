<?php

namespace App\Wrappers\EMS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

/**
 * Class EMS
 *
 * EMS ticketing provider API wrapper, access the showings database
 */
class EMS
{
    use CastsToShowing;
    use MatchesShows;

    protected string $endpoint;
    protected string $username;
    protected string $password;
    protected Client $client;

    /**
     * EMS constructor.
     */
    public function __construct()
    {
        $this->endpoint = config('services.ems.endpoint');
        $this->username = config('services.ems.username');
        $this->password = config('services.ems.password');
        $this->client = new Client();
    }

    /**
     * Get the showings for all shows
     *
     * @return Collection
     *
     * @throws GuzzleException
     */
    public static function showingsByShow(): Collection
    {
        $ems = new static();
        $response = $ems->_call();
        $shows = json_decode($response)->sites[0]->events;
        $shows = collect($shows);
        $shows = self::matchShows($shows);

        return $shows;
    }

    public static function showsForMatching(): Collection
    {
        $shows = self::showingsByShow();
        session(['shows_to_import' => $shows]);
        $shows_for_matching = $shows->where('id', null);
        return $shows_for_matching;
    }

    /**
     * Call the API
     *
     * @return string
     *
     * @throws GuzzleException
     */
    private function _call(): string
    {
        $response = $this->client->request(
            'GET', $this->endpoint, [
                'auth' => [$this->username, $this->password]
            ]
        )->getBody();
        return (string) $response;
    }
}

