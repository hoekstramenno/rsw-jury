<?php

namespace Tests\Support\Statistics;

use App\Models\Group;
use App\Models\Team;
use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupStatisticsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_get_group_statistics_for_every_year(): void
    {
        $group = factory(Group::class)->create();

        $years = factory(Year::class, 3)->create();

        $teams = factory(Team::class, 3)->create([
            'group_id' => $group->id,
            'year_id' => $years->splice(0,1)
        ]);


    }
}
