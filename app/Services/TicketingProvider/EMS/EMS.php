<?php

namespace App\Services\TicketingProvider\EMS;

use App\Models\Programming;
use App\Services\TicketingProvider\TicketingProvider;
use App\Models\Week;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * Class EMS
 *
 * EMS ticketing provider API wrapper, access the showings database
 */
class EMS implements TicketingProvider
{
    use CastsToShowing;
    use MatchesShows;
    use ManipulateShows;

    /**
     * @var array<string>
     */
    protected array $config;
    protected Client $client;
    protected Collection $shows;
    protected Collection $shows_to_match;
    protected Collection $showings;

    public function __construct()
    {
        $this->config['endpoint'] = config('services.ems.endpoint');
        $this->config['username'] = config('services.ems.username');
        $this->config['password'] = config('services.ems.password');
        $this->client = new Client();
        $this->shows = new Collection();
        $this->shows_to_match = new Collection();
        $this->showings = new Collection();
    }

    public function setShowsWithShowings(?Collection $shows = null): void
    {
        if ($shows) {
            $this->shows = $shows;
        } else {
            $this->_fetchShowsWithShowings();
        }
        $this->_matchShows();
    }

    public function getShowsWithShowings(): Collection
    {
        if ($this->shows->isEmpty()) {
            $this->setShowsWithShowings();
        }
        return $this->shows;
    }

    public function getShowsToMatch(): Collection
    {
        return $this->shows_to_match;
    }

    public function getAllShowings(): Collection
    {
        $weeks = Week::select('id', 'number', 'start', 'end')
            ->where('end', '>=', Carbon::now())->get();

        $programmings = Programming::select('id', 'show_id', 'week_id')
            ->whereIn(
                'week_id',
                array_values($weeks->pluck('id')->all())
            )->get();

        $this->shows->each(
            function ($show) use ($weeks, $programmings) {
                $show->sessions->each(
                    function ($session) use ($show, $weeks, $programmings) {
                        $this->showings->push(
                            self::toShowing(
                                $session,
                                $show,
                                $weeks,
                                $programmings
                            )
                        );
                    }
                );
            }
        );

        return $this->showings;
    }

    /**
     * Get the showings for all shows
     *
     * @throws RequestException
     */
    private function _fetchShowsWithShowings(): void
    {
        $response = $this->_call();
        $shows = json_decode($response)->sites[0]->events;
        $this->shows = new Collection($shows);
        $this->_handleShowings();
    }

    /**
     * Call the API
     *
     * @throws RequestException
     */
    private function _call(): string
    {
        $response = Http::withBasicAuth(
            $this->config['username'],
            $this->config['password'],
        )->get($this->config['endpoint'])->throw();
        file_put_contents('prog.txt', $response->body());
        return (string) $response->body();
    }
}
