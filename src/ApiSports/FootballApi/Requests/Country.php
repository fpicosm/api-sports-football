<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class Country extends FootballApiClient
{
    /**
     * Get the list of available countries for the "leagues" endpoint.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Countries/operation/get-countries
     * @param   array   $query  the query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(array $query = []): object
    {
        return $this->call('countries', $query);
    }
}