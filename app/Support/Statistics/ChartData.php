<?php

namespace App\Support\Statistics;

use Illuminate\Support\Collection;

class ChartData
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $labels;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $datasets;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $options;

    public function __construct(Collection $labels, Collection $dataSets)
    {
        $this->labels   = $labels;
        $this->datasets = $dataSets;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getDataSets(): \Illuminate\Support\Collection
    {
        return $this->datasets;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getLabels(): \Illuminate\Support\Collection
    {
        return $this->labels;
    }

    public function toGraphData(): string
    {
        return json_encode(
            [
                'labels'   => $this->getLabels(),
                'datasets' => $this->datasets->toArray(),
            ]
        );
    }

}
