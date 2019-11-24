<?php

namespace App\JsonApi\Scores;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'scores';

    /**
     * @param object $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param object $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'score'      => $resource->score,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

    public function getRelationships($score, $isPrimary, array $includeRelationships): array
    {
        return [
            'rating' => [
                self::DATA => function () use ($score) {
                    return $score->rating;
                },
                self::META => function () use ($score) {
                    return [
                        'name' => $score->rating->name,
                    ];
                },
            ],
            'team'   => [
                self::DATA => function () use ($score) {
                    return $score->team;
                },
                self::META => function () use ($score) {
                    return [
                        'name' => $score->team->name,
                    ];
                },
            ],
        ];
    }
}
