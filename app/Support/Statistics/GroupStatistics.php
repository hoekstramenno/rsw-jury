<?php

namespace App\Support\Statistics;

use App\Models\Group;
use Illuminate\Support\Collection;

class GroupStatistics
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $statistics;

    /**
     * @var \App\Models\Group
     */
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
        $stats       = collect([]);

        $teams = $group->teams()->with(['year'])->get();

        foreach ($teams as $team) {
            $yearLabel = $team->year->label;

            /** @todo this can be better */
            if ($stats->has($yearLabel) === false) {
                $stats->put($yearLabel, collect([]));
            }

            $stats->get($yearLabel)->push(new TeamStatistics($team));
        }

        $this->statistics = $stats;
    }

    public function getTotalScorePerYear(): Collection
    {
        return $this->statistics->mapWithKeys(
            function (Collection $years, int $year) {
                $totalTeams = $years->count();
                $totalScore = $years->reduce(
                    function ($carry, TeamStatistics $stats) {
                        return $carry + $stats->getTotalTeamScore()->getTotal();
                    },
                    0
                );

                if ($totalTeams === 0) {
                    return [$year => 0];
                }

                return [$year => $totalScore / $totalTeams];
            }
        );
    }

    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function getGroup(): Group
    {
        return $this->group;
    }
}
