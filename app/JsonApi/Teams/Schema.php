<?php

namespace App\JsonApi\Teams;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'teams';

    /**
     * @param object $resource the domain record being serialized.
     * @return string
     */
    public function getId($resource) : string
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param object $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource):array
    {
        return [
            'number' => $resource->start_number,
            'name' => $resource->name,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

    public function getRelationships($team, $isPrimary, array $includeRelationships): array
    {
        return [
            'group' => [
                self::DATA => function () use ($team) {
                    return $team->group;
                },
                self::META => function () use ($team) {
                    return [
                        'name' => $team->group->name,
                    ];
                },
            ],
            'year' => [
                self::DATA => function () use ($team) {
                    return $team->year;
                },
            ],
        ];
    }
}
