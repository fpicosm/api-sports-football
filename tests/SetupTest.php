<?php

use ApiSports\FootballApi\FootballApiClient;
use Illuminate\Support\Facades\Config;

class SetupTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_an_exception_if_no_api_key_set()
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('football-api.api_key', '');
        new FootballApiClient();
    }
}