<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class FixtureTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_an_exception_if_no_params_passed()
    {
        $this->expectExceptionMessage('At least one parameter is required');
        FootballApi::fixtures()->get();
    }

    /**
     * @test
     */
    public function it_retrieves_fixture_data()
    {
        $data = FootballApi::fixtures()->get(['id' => $this->fixtureId]);
        $this->assertCount(1, $data->response);
        $this->assertEquals('fixtures', $data->get);
        $this->assertEquals($this->fixtureId, $data->parameters->id);
    }
}