<?php

namespace ApiSports\FootballApi\Requests;

use ApiSports\FootballApi\FootballApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class Timezone extends FootballApiClient
{
    /**
     * Get the list of available timezone to be used in the "fixtures" endpoint.
     *
     * @link    https://api-sports.io/documentation/football/v3#tag/Timezone/operation/get-timezone
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    public function get(): object
    {
        return $this->call('timezone');
    }
}