<?php

use ApiSports\FootballApi\Facades\FootballApi;

/**
 * @group competition
 */
class CoachTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_an_exception_if_no_params_passed()
    {
        $this->expectExceptionMessage('At least one parameter is required');
        FootballApi::coaches()->get();
    }

    /**
     * @test
     */
    public function it_retrieves_coaches()
    {
        $data = FootballApi::coaches()->get(['search' => 'simeone']);

        $this->assertNotEmpty($data->response);
        $this->assertEquals('coachs', $data->get);
        $this->assertEquals('simeone', $data->parameters->search);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_no_coach_id_set()
    {
        $this->expectException(InvalidArgumentException::class);
        FootballApi::coaches()->trophies();
    }

    /**
     * @test
     */
    public function it_retrieves_coach_data()
    {
        $coach = FootballApi::coaches($this->coachId);

        $trophies = $coach->trophies();
        $this->assertNotEmpty($trophies->response);
        $this->assertEquals('trophies', $trophies->get);
        $this->assertEquals($this->coachId, $trophies->parameters->coach);

        $sidelined = $coach->sidelined();
        $this->assertNotEmpty($sidelined->response);
        $this->assertEquals('sidelined', $sidelined->get);
        $this->assertEquals($this->coachId, $sidelined->parameters->coach);
    }
}