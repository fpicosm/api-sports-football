<?php

namespace ApiSports\FootballApi\Facades;

use Illuminate\Support\Facades\Facade;

class FootballApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'football-api';
    }
}