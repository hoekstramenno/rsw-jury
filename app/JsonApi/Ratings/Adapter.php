<?php

namespace App\JsonApi\Ratings;

use App\Models\Criteria;
use App\Models\Rating;
use App\Models\RatingCategory;
use App\Models\Score;
use App\Models\Year;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Eloquent\BelongsTo;
use CloudCreativity\LaravelJsonApi\Eloquent\HasMany;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Rating(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if ($year = $filters->get('year')) {
            $query->whereHas('year', function ($query) use($year) {
                $query->where('label', $year);
            })->get();
        }
    }

    public function scores(): HasMany
    {
        return $this->hasMany('scores');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('category');
    }

    public function criteria(): HasMany
    {
        return $this->hasMany('criteria');
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo('years');
    }
}
