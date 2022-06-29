<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class Venue extends FootballApiClient
{
    /**
     * Get the list of available venues (at least one parameter is required).
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Venues/operation/get-venues
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(array $query = []): object
    {
        return $this->call('venues', $query);
    }

    /**
     * Get the information about the venue.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Venues/operation/get-venues
     * @param   int         $id the venue id
     * @return  object|null the response data
     * @throws  Exception|GuzzleException
     */
    public function find(int $id): ?object
    {
        return $this->callItem('venues', ['id' => $id]);
    }
}