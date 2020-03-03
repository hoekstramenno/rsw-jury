<?php

namespace App\Support\Statistics;

use Illuminate\Support\Collection;

class TeamCategoryStatisticsCollection extends Collection
{
    public function add($item)
    {
        if ($item instanceof TeamCategoryStatistics === false) {
            return $this;
        }

        $this->items[] = $item;

        return $this;
    }

    public function getLabels(): Collection
    {
        return $this->map(
            function (TeamCategoryStatistics $stats) {
                return $stats->getCategory()->name;
            }
        )->values();
    }

    public function getPercentages()
    {
        return $this->map(
            function (TeamCategoryStatistics $stats) {
                return $stats->getPercentage();
            }
        )->values();
    }
}
