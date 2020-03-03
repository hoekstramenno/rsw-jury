<?php

namespace Tests\Support\Result;

use App\Models\Rating;
use App\Models\Team;
use App\Support\Result\TotalTeamScore;
use Tests\TestCase;

class TotalTeamScoreTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_construct_with_a_team(): void
    {
        $team           = new Team();
        $totalTeamScore = new TotalTeamScore($team);

        static::assertEquals($team, $totalTeamScore->getTeam());
    }

    /**
     * @test
     */
    public function it_can_add_a_rating_with_score_to_a_team(): void
    {
        $team           = new Team();
        $totalTeamScore = new TotalTeamScore($team);
        $rating         = new Rating();

        $totalTeamScore->addScore($rating, 10);

        static::assertEquals(
            collect(
                [
                    10,
                ]
            ),
            $totalTeamScore->getScores()
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_total_score_to_a_team(): void
    {
        $team           = new Team();
        $totalTeamScore = new TotalTeamScore($team);
        $rating         = new Rating();

        $totalTeamScore->addScore($rating, 10);
        $totalTeamScore->addScore($rating, 5);

        static::assertEquals(
            15,
            $totalTeamScore->getTotal()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_max_score(): void
    {
        $team           = new Team();
        $totalTeamScore = new TotalTeamScore($team);

        static::assertEquals(
            config('rsw.max_score'),
            $totalTeamScore->getMaxScore()
        );
    }

    /**
     * @test
     */
    public function it_can_calculate_percentage_of_max_score(): void
    {
        $team           = new Team();
        $totalTeamScore = new TotalTeamScore($team);

        $rating = new Rating();

        $totalTeamScore->addScore($rating, 10);
        $totalTeamScore->addScore($rating, 10);

        static::assertEquals(
            1,
            $totalTeamScore->getPercentage()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_all_relevant_info_as_array(): void
    {
        $team           = new Team();
        $totalTeamScore = new TotalTeamScore($team);

        $rating = new Rating();

        $totalTeamScore->addScore($rating, 10);
        $totalTeamScore->addScore($rating, 10);

        static::assertEquals(
            [
                'team'       => $team,
                'scores'     => collect([10, 10]),
                'total'      => 20,
                'percentage' => 1.0,
                'max_score'  => config('rsw.max_score'),
            ],
            $totalTeamScore->toArray()
        );
    }
}
