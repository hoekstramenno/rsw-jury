<?php

namespace App\JsonApi\Years;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'years';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource) : string
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource): array
    {
        return [
            'label' => $resource->label,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

    public function getRelationships($year, $isPrimary, array $includeRelationships): array
    {
        return [
            'teams' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::META => function () use ($year) {
                    return [
                        'total' => $year->group_count ?? 0,
                    ];
                },
            ],
            'ratings' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ],
        ];
    }
}
