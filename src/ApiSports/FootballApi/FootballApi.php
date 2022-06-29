<?php

namespace ApiSports\FootballApi;

use ApiSports\FootballApi\Requests\Coach;
use ApiSports\FootballApi\Requests\Country;
use ApiSports\FootballApi\Requests\Fixture;
use ApiSports\FootballApi\Requests\League;
use ApiSports\FootballApi\Requests\Player;
use ApiSports\FootballApi\Requests\Team;
use ApiSports\FootballApi\Requests\Timezone;
use ApiSports\FootballApi\Requests\Venue;

class FootballApi
{
    public function coaches(?int $id = null): Coach
    {
        return new Coach($id);
    }

    public function countries(): Country
    {
        return new Country();
    }

    public function fixtures(?int $id = null): Fixture
    {
        return new Fixture($id);
    }

    public function leagues(?int $id = null, ?int $season = null): League
    {
        return new League($id, $season);
    }

    public function players(?int $id = null): Player
    {
        return new Player($id);
    }

    public function teams(?int $id = null): Team
    {
        return new Team($id);
    }

    public function timezones(): Timezone
    {
        return new Timezone();
    }

    public function venues(): Venue
    {
        return new Venue();
    }
}