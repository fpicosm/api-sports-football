<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class League extends FootballApiClient
{
    protected ?int $id;
    protected ?int $season;

    /**
     * Init season
     *
     * @param int|null  $id     the league id
     * @param int|null  $season the season year
     */
    public function __construct(?int $id, ?int $season)
    {
        parent::__construct();

        $this->id = $id;
        $this->season = $season;
    }

    /**
     * Get the list of available competitions.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Leagues/operation/get-leagues
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(array $query = []): object
    {
        return $this->call('leagues', $query);
    }

    /**
     * Get the competition details.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Leagues/operation/get-leagues
     * @param   int         $id the competition id
     * @return  object|null the response data
     * @throws  Exception|GuzzleException
     */
    public function find(int $id): ?object
    {
        return $this->callItem('leagues', ['id' => $id]);
    }

    /**
     * Get the list of available seasons.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Leagues/operation/get-seasons
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function seasons(): object
    {
        return $this->call('leagues/seasons');
    }

    /**
     * Get the fixtures for a season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures
     * @param   array   $query    the query params
     * @return  object  the response data
     * @throws  GuzzleException
     */
    public function fixtures(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('fixtures', [
            'league' => $this->id,
            'season' => $this->season,
            ...$query,
        ]);
    }

    /**
     * Get the list of players not participating in the fixtures for various reasons such as suspended, injured for example
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Injuries/operation/get-injuries
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function injuries(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('injuries', [
            'league' => $this->id,
            'season' => $this->season,
            ...$query
        ], true);
    }

    /**
     * Get the list of players from a season
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players
     * @param   int     $page   the page
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function players(int $page = 1, array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('players', [
            'league' => $this->id,
            'season' => $this->season,
            'page' => $page,
            ...$query
        ]);
    }

    /**
     * Get the rounds for a season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures-rounds
     * @param   array   $query    the query params
     * @return  object  the response data
     * @throws  GuzzleException
     */
    public function rounds(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('fixtures/rounds', [
            'league' => $this->id,
            'season' => $this->season,
            ...$query,
        ]);
    }

    /**
     * Get the standings for a season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Standings/operation/get-standings
     * @param   array   $query    the query params
     * @return  object  the response data
     * @throws  GuzzleException
     */
    public function standings(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('standings', [
            'league' => $this->id,
            'season' => $this->season,
            ...$query,
        ]);
    }

    /**
     * Get the best players in terms of assists for a season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players-topassists
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function topAssists(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('players/topassists', [
            'league' => $this->id,
            'season' => $this->season,
        ]);
    }

    /**
     * Get the players with the most red cards for a season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players-topredcards
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function topRedCards(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('players/topredcards', [
            'league' => $this->id,
            'season' => $this->season,
        ]);
    }

    /**
     * Get the best players in terms of goals scored for a season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players-topscorers
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function topScorers(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('players/topscorers', [
            'league' => $this->id,
            'season' => $this->season,
        ]);
    }

    /**
     * Get the players with the most yellow cards for a season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players-topyellowcards
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function topYellowCards(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No league ID set');
        if (empty($this->season)) throw new InvalidArgumentException('No season year set');

        return $this->call('players/topyellowcards', [
            'league' => $this->id,
            'season' => $this->season,
        ]);
    }
}