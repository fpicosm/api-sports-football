<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class VenueTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_an_exception_if_no_params_passed()
    {
        $this->expectExceptionMessage('At least one parameter is required');
        FootballApi::venues()->get();
    }

    /**
     * @test
     */
    public function it_retrieves_venues_by_country()
    {
        $data = FootballApi::venues()->get(['country' => 'spain']);

        $this->assertNotEmpty($data->response);
        $this->assertEquals('venues', $data->get);
        $this->assertEquals('spain', $data->parameters->country);
    }
}