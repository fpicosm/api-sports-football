<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class Player extends FootballApiClient
{
    protected ?int $id;

    /**
     * Init player
     *
     * @param int|null  $id the player id
     */
    public function __construct(?int $id)
    {
        parent::__construct();

        $this->id = $id;
    }

    /**
     * Get players statistics (at least one parameter is required).
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(array $query = []): object
    {
        return $this->call('players', $query);
    }

    /**
     * Get all available seasons for a given player.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players-seasons
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function seasons(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No player ID set');

        return $this->call('players/seasons', ['player' => $this->id]);
    }

    /**
     * Get all available sidelined for a player.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Sidelined/operation/get-sidelined
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function sidelined(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No player ID set');

        return $this->call('sidelined', [ 'player' => $this->id ]);
    }

    /**
     * Get the set of teams associated with the player.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players-squads
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function squads(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No player ID set');

        return $this->call('players/squads', [
            'player' => $this->id,
            ...$query,
        ]);
    }

    /**
     * Get player statistics for a given season.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Players/operation/get-players
     * @param   int     $season the season year
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function statistics(int $season, array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No player ID set');

        return $this->call('players', [
            'id' => $this->id,
            'season' => $season,
            ...$query,
        ]);
    }

    /**
     * Get all available transfers for a player.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Transfers/operation/get-transfers
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function transfers(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No player ID set');

        return $this->call('transfers', [
            'player' => $this->id,
            ...$query,
        ]);
    }

    /**
     * Get all available trophies for a player.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Trophies/operation/get-trophies
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function trophies(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No player ID set');

        return $this->call('trophies', [
            'player' => $this->id,
            ...$query,
        ]);
    }
}