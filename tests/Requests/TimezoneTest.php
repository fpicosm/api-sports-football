<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class TimezoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_timezones()
    {
        $data = FootballApi::timezones()->get();

        $this->assertNotEmpty($data->response);
        $this->assertEquals('timezone', $data->get);
        $this->assertEmpty($data->parameters);
    }

    /**
     * @test
     */
    public function it_contains_only_valid_timezones()
    {
        $data = FootballApi::timezones()->get();

        $this->assertContains('Europe/Madrid', $data->response);
        $this->assertNotContains('Europe/Barcelona', $data->response);
    }
}