<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class TeamTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_an_exception_if_no_params_passed()
    {
        $this->expectExceptionMessage('At least one parameter is required');
        FootballApi::teams()->get();
    }

    /**
     * @test
     */
    public function it_retrieves_h2h()
    {
        $data = FootballApi::teams($this->teamId)->h2h(530);

        $this->assertNotEmpty($data->response);
        $this->assertEquals("{$this->teamId}-530", $data->parameters->h2h);
    }
}