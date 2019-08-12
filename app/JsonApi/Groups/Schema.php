<?php

namespace App\JsonApi\Groups;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'groups';

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
    public function getAttributes($resource) : array
    {
        return [
            'name' => $resource->name,
            'city' => $resource->city,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

    public function getRelationships($group, $isPrimary, array $includeRelationships): array
    {
        return [
            'teams' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ],
        ];
    }
}
