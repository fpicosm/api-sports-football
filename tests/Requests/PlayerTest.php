<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class PlayerTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_an_exception_if_no_params_passed()
    {
        $this->expectExceptionMessage('At least one parameter is required');
        FootballApi::players()->get();
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_no_season_passed()
    {
        $this->expectExceptionMessage('Season field is required');
        FootballApi::players()->get(['id' => $this->playerId]);
    }

    /**
     * @test
     */
    public function it_retrieves_player_statistics()
    {
        $data = FootballApi::players()->get(['id' => $this->playerId, 'season' => $this->season]);

        $this->assertNotEmpty($data->response);
        $this->assertEquals('players', $data->get);
        $this->assertCount(2, get_object_vars($data->parameters));
        $this->assertEquals($this->playerId, $data->parameters->id);
        $this->assertEquals($this->season, $data->parameters->season);
        $this->assertCount(1, $data->response);
        $this->assertEquals($this->playerId, $data->response[0]->player->id);
    }
}