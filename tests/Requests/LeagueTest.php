<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class LeagueTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_leagues()
    {
        $data = FootballApi::leagues()->get();

        $this->assertEquals('leagues', $data->get);
        $this->assertEmpty($data->parameters);
        $this->assertNotEmpty($data->response);
    }

    /**
     * @test
     */
    public function it_retrieves_seasons()
    {
        $data = FootballApi::leagues()->seasons();
        $this->assertNotEmpty($data->response);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_no_league_id_set()
    {
        $this->expectException(InvalidArgumentException::class);
        FootballApi::leagues()->standings();
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_no_season_year_set()
    {
        $this->expectException(InvalidArgumentException::class);
        FootballApi::leagues($this->leagueId)->standings();
    }

    /**
     * @test
     */
    public function it_retrieves_league_standings()
    {
        $data = FootballApi::leagues($this->leagueId, $this->season)->standings();

        $this->assertNotEmpty($data->response);
        $this->assertEquals('standings', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);
    }

    /**
     * @test
     */
    public function it_retrieves_league_rounds()
    {
        $data = FootballApi::leagues($this->leagueId, $this->season)->rounds();

        $this->assertNotEmpty($data->response);
        $this->assertEquals('fixtures/rounds', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);
    }

    /**
     * @test
     */
    public function it_retrieves_league_fixtures()
    {
        $data = FootballApi::leagues($this->leagueId, $this->season)->fixtures();

        $this->assertNotEmpty($data->response);
        $this->assertEquals('fixtures', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);
    }

    /**
     * @test
     */
    public function it_retrieves_league_injuries()
    {
        $data = FootballApi::leagues($this->leagueId, $this->season)->injuries();

        $this->assertNotEmpty($data->response);
        $this->assertEquals('injuries', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);
    }

    /**
     * @test
     */
    public function it_retrieves_league_player_rankings()
    {
        $league = FootballApi::leagues($this->leagueId, $this->season);

        $data = $league->topScorers();
        $this->assertNotEmpty($data->response);
        $this->assertEquals('players/topscorers', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);

        $data = $league->topAssists();
        $this->assertNotEmpty($data->response);
        $this->assertEquals('players/topassists', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);

        $data = $league->topYellowCards();
        $this->assertNotEmpty($data->response);
        $this->assertEquals('players/topyellowcards', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);

        $data = $league->topRedCards();
        $this->assertNotEmpty($data->response);
        $this->assertEquals('players/topredcards', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);
    }

    /**
     * @test
     */
    public function it_retrieves_league_players()
    {
        $league = FootballApi::leagues($this->leagueId, $this->season);

        $data = $league->players();

        $this->assertNotEmpty($data->response);
        $this->assertEquals('players', $data->get);
        $this->assertEquals($this->leagueId, $data->parameters->league);
        $this->assertEquals($this->season, $data->parameters->season);

        $page = $data->paging->total + 1;
        $data = $league->players($page);
        $this->assertEmpty($data->response);
        $this->assertEquals($page, $data->parameters->page);
    }
}