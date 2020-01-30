<?php

namespace Tests\Support\Result;

use App\Models\Rating;
use App\Models\Score;
use App\Models\Team;
use App\Support\Result\TotalScore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class TotalScoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_calculate_total_score(): void
    {
        /** @var \Illuminate\Support\Collection $ratings */
        $ratings = factory(Rating::class, 4)->create([
            'points'             => 15,
            'factor'             => 4,
            'rating_category_id' => null,
            'year_id'            => date('Y'),
        ]);

        /** @var \Illuminate\Support\Collection $teams */
        $teams = factory(Team::class, 2)->create([
            'year_id'  => date('Y'),
        ]);

        $ratings->each(function (Rating $rating) use ($teams) {
            $teams->each(function (Team $team) use ($rating) {
                $team->scores()->save(
                    factory(Score::class)->create([
                        'rating_id' => $rating,
                        'team_id' => $team,
                        'score' => 8
                    ])
                );
            });
        });

        $totalScore = new TotalScore($ratings, $teams);

        $results = $totalScore->calculate();

        static::assertInstanceOf(Collection::class, $results);
        static::assertCount(2, $results);
        static::assertEquals(128, $results->first()->getTotal());
    }
}
