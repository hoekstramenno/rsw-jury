<?php

namespace App\JsonApi\Years;

use App\Models\Year;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Eloquent\HasMany;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{
    protected $primaryKey = 'label';


    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Year(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        // TODO
    }

    protected function teams(): HasMany
    {
        return $this->hasMany('teams');
    }

    protected function ratings(): HasMany
    {
        return $this->hasMany('ratings');
    }

}
