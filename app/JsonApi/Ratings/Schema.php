<?php

namespace App\JsonApi\Ratings;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'ratings';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'number' => $resource->number,
            'suffix' => $resource->suffix,
            'name' => $resource->name,
            'points' => $resource->points,
            'factor' => $resource->factor,
            'outside-competition' => $resource->outside_competition,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

    public function getRelationships($rating, $isPrimary, array $includeRelationships): array
    {
        return [
            'rating_category' => [
                self::DATA => function () use ($rating) {
                    return $rating->ratingCategory;
                },
                self::META => function () use ($rating) {
                    return [
                        'name' => $rating->ratingCategory->name,
                    ];
                },
            ],
            'year' => [
                self::DATA => function () use ($rating) {
                    return $rating->year;
                },
            ],
            'scores' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::META => function () use ($rating) {
                    return [
                        'total' => $rating->scores
                    ];
                },
            ],
        ];
    }
}
