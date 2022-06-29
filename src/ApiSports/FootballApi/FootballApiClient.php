<?php

namespace ApiSports\FootballApi;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class FootballApiClient
{
    protected Client $client;

    public function __construct()
    {
        $apiKey = config('football-api.api_key');
        if (empty($apiKey)) throw new InvalidArgumentException('No API key set');

        $origin = strtolower(config('football-api.api_origin'));
        if (empty($origin)) throw new InvalidArgumentException('No API origin set');

        $baseUrl = [
            'rapidapi' => 'https://api-football-v1.p.rapidapi.com/v3/',
            'api-sports' => 'https://v3.football.api-sports.io/',
        ];
        if (!array_key_exists($origin, $baseUrl)) throw new InvalidArgumentException('Invalid API origin');

        $options = [
            'base_uri' => $baseUrl[$origin],
            'headers' => [
                'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                'X-RapidAPI-Key' => $apiKey,
            ],
            'verify' => !(app('env') === 'testing'),
        ];

        $this->client = new Client($options);
    }

    /**
     * @param   string  $url    the api url
     * @param   array   $query  the query params
     * @param   bool    $useTimezone    add timezone to query params
     * @return  object  the response data
     * @throws  Exception|GuzzleException
     */
    protected function call(string $url, array $query = [], bool $useTimezone = false): object
    {
        if ($useTimezone) $query['timezone'] = $query['timezone'] ?? config('football-api.api_timezone');

        $response = $this->client->get($url, ['query' => $query]);

        $body = json_decode($response->getBody()->getContents());

        $errors = $body->errors;

        if (empty($errors)) return $body;

        // TODO errors
        $array = get_object_vars($errors);
        $message = array_values($array)[0];
        throw new Exception($message);
    }

    /**
     * @param   string      $url    the api url
     * @param   array       $query  the query params
     * @param   bool        $useTimezone    add timezone to query params
     * @return  object|null the response data
     * @throws  Exception|GuzzleException
     */
    protected function callItem(string $url, array $query = [], bool $useTimezone = false): ?object
    {
        $response = $this->call($url, $query, $useTimezone)->response;

        if (!empty($response)) return $response[0];
        return null;
    }
}