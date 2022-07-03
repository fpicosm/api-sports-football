<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class Team extends FootballApiClient
{
    protected ?int $id;

    /**
     * Init team
     *
     * @param int|null  $id the team id
     */
    public function __construct(?int $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    /**
     * Get the list of available teams (at least one parameter is required).
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Teams/operation/get-teams
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(array $query = []): object
    {
        return $this->call('teams', $query);
    }

    /**
     * Get the team information.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Teams/operation/get-teams
     * @param   int         $id the team id
     * @return  object|null the response data
     * @throws  Exception|GuzzleException
     */
    public function find(int $id): ?object
    {
        return $this->callItem('teams', ['id' => $id]);
    }

    /**
     * Get the list of countries available for the "teams" endpoint.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Teams/operation/get-teams-countries
     * @return  object  the response data
     * @throws  GuzzleException
     */
    public function countries(): object
    {
        return $this->call('teams/countries');
    }

    /**
     * Get head to head between two teams.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures-headtohead
     * @param   int     $opponentId the team id
     * @param   array   $query      the query params
     * @return  object  the response data
     * @throws  GuzzleException
     */
    public function h2h(int $opponentId, array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No team ID set');

        return $this->call('fixtures/headtohead', [
            'h2h' => "{$this->id}-{$opponentId}",
            ...$query,
        ]);
    }

    /**
     * Get the list of seasons available for a team.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Teams/operation/get-teams-seasons
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function seasons(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No team ID set');

        return $this->call('teams/seasons', [
            'team' => $this->id,
        ]);
    }

    /**
     * Get the current squad of a team.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players-squads
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function squad(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No team ID set');

        return $this->call('players/squads', [
            'team' => $this->id,
            ...$query,
        ]);
    }

    /**
     * Get the standings for a team given the year.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Standings/operation/get-standings
     * @param   int     $year   the year
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  GuzzleException
     */
    public function standings(int $year, array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No team ID set');

        return $this->call('standings', [
            'team' => $this->id,
            'season' => $year,
            ...$query,
        ]);
    }

    /**
     * Returns the statistics of a team in relation to a given competition and season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Teams/operation/get-teams-statistics
     * @param   int     $leagueId   the competition id
     * @param   int     $season     the season year
     * @param   array   $query      the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function statistics(int $leagueId, int $season, array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No team ID set');

        return $this->call('teams/statistics', [
            'team' => $this->id,
            'league' => $leagueId,
            'season' => $season,
            ...$query,
        ]);
    }

    /**
     * Get all available transfers for a team
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Transfers/operation/get-transfers
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function transfers(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No team ID set');

        return $this->call('transfers', [
            'team' => $this->id,
            ...$query,
        ]);
    }
}