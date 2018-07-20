<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Ellllllen\PersonalWebsite\Activities\Activities;
use Ellllllen\PersonalWebsite\Activities\Activity;
use Ellllllen\PersonalWebsite\Activities\GetActivities;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class GetActivitiesTest extends TestCase
{
    private $testClass;
    private $mockActivities;

    public function setUp()
    {
        parent::setUp();

        $this->mockActivities = Mockery::mock(Activities::class);

        $this->testClass = new GetActivities($this->mockActivities);
    }

    /**
     * @test
     */
    public function it_gets_activities_with_a_limit()
    {
        $testActivities = $this->getTestActivities();

        $expected = new Collection($testActivities);
        $this->mockActivities->shouldReceive('get')
            ->with(1000)
            ->andReturn($expected);

        $result = $this->testClass->get(1000);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function it_gets_activities_without_a_limit()
    {
        $testActivities = $this->getTestActivities();

        $expected = new Collection($testActivities);
        $this->mockActivities->shouldReceive('get')
            ->with(5)
            ->andReturn($expected);

        $result = $this->testClass->get();

        $this->assertEquals($expected, $result);
    }

    /**
     * Dummy data
     * @return array
     */
    private function getTestActivities()
    {
        return [
            new Activity('title', 'desc', new Carbon(now())),
            new Activity('title2', 'desc2', new Carbon(now()))
        ];
    }
}
