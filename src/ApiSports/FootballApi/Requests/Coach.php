<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class Coach extends FootballApiClient
{
    protected ?int $id;

    /**
     * Init coach
     *
     * @param int|null  $id  the coach id
     */
    public function __construct(?int $id)
    {
        parent::__construct();

        $this->id = $id;
    }

    /**
     * Get all the information about the coaches and their careers.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Coachs/operation/get-coachs
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(array $query = []): object
    {
        return $this->call('coachs', $query);
    }

    /**
     * Get the information about the coach and him/her career.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Coachs/operation/get-coachs
     * @param   int         $id the coach id
     * @return  object|null the response data
     * @throws  Exception|GuzzleException
     */
    public function find(int $id): ?object
    {
        return $this->callItem('coachs', ['id' => $id]);
    }

    /**
     * Get all available trophies for a coach.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Trophies/operation/get-trophies
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function trophies(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No coach ID set');

        return $this->call('trophies', ['coach' => $this->id]);
    }

    /**
     * Get all available sidelined for a coach.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Sidelined/operation/get-sidelined
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function sidelined(): object
    {
        if (empty($this->id)) throw new InvalidArgumentException('No coach ID set');

        return $this->call('sidelined', [ 'coach' => $this->id ]);
    }
}