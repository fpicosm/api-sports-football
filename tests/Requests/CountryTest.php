<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class CountryTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_countries()
    {
        $data = FootballApi::countries()->get();
        $this->assertNotEmpty($data->response);
    }

    /**
     * @test
     */
    public function it_retrieves_country_by_name()
    {
        $data = FootballApi::countries()->get(['name' => 'spain']);

        $this->assertEquals('countries', $data->get);
        $this->assertEquals('spain', $data->parameters->name);
        $this->assertCount(1, $data->response);
    }

    /**
     * @test
     */
    public function it_retrieves_country_by_code()
    {
        $data = FootballApi::countries()->get(['code' => 'gb']);

        $this->assertEquals('countries', $data->get);
        $this->assertEquals('gb', $data->parameters->code);
        $this->assertCount(4, $data->response);
    }
}