<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class Fixture extends FootballApiClient
{
    protected ?int $id;

    /**
     * Init fixture
     *
     * @param int|null  $id the fixture id
     */
    public function __construct(?int $id)
    {
        parent::__construct();

        $this->id = $id;
    }

    /**
     * Get the list of fixtures (at least one parameter is required).
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(array $query = []): object
    {
        return $this->call('fixtures', $query, true);
    }

    /**
     * Get the fixture information.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures
     * @param   int         $id the fixture id
     * @return  object|null the response data
     * @throws  Exception|GuzzleException
     */
    public function find(int $id): ?object
    {
        return $this->callItem('fixtures', ['id' => $id], true);
    }

    /**
     * Get the events from a fixture.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures-events
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function events(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No fixture ID set');

        return $this->call('fixtures/events', [
            'fixture' => $this->id,
            ...$query,
        ]);
    }

    /**
     * Get the list of players not participating in the fixture for various reasons such as suspended, injured for example.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Injuries/operation/get-injuries
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function injuries(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No fixture ID set');

        return $this->call('injuries', [
            'fixture' => $this->id,
            ...$query
        ], true);
    }

    /**
     * Get the lineups for a fixture.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures-lineups
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function lineups(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No fixture ID set');

        return $this->call('fixtures/lineups', [
            'fixture' => $this->id,
            ...$query,
        ]);
    }

    /**
     * Get the player's statistics from one fixture.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures-players
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function players(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No fixture ID set');

        return $this->call('fixtures/players', [
            'fixture' => $this->id,
            ...$query,
        ]);
    }

    /**
     * Get predictions about a fixture.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Predictions/operation/get-predictions
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function predictions(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No fixture ID set');

        return $this->call('predictions', [ 'fixture' => $this->id ]);
    }

    /**
     * Get the statistics for one fixture.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Fixtures/operation/get-fixtures-statistics
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function statistics(array $query = []): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No fixture ID set');

        return $this->call('fixtures/statistics', [
            'fixture' => $this->id,
            ...$query,
        ]);
    }
}