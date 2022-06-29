<?php

use ApiSports\FootballApi\FootballApiServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected int $leagueId, $season, $coachId, $fixtureId, $playerId;

    public function setUp(): void
    {
        parent::setup();

        Config::set('football-api.api_origin', 'YOUR_ORIGIN');
        Config::set('football-api.api_key', 'YOUR_API_KEY');

        $this->leagueId = 140;
        $this->season = 2021;
        $this->fixtureId = 720752;
        $this->teamId = 529;
        $this->playerId = 642;
        $this->coachId = 1595;
    }

    /**
     * Boots the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(FootballApiServiceProvider::class);

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }
}