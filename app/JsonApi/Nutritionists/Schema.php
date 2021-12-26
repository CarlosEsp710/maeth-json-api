<?php

namespace App\JsonApi\Nutritionists;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'nutritionists';

    /**
     * @param \App\Nutritionist $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Nutritionist $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($nutritionist)
    {
        return [
            'curriculum' => $nutritionist->curriculum,
            'identification_card' => $nutritionist->identification_card,
            'specializations' => $nutritionist->specializations,
        ];
    }

    public function getRelationships($nutritionist, $isPrimary, array $includeRelationships)
    {

        return [
            'patients' => [
                self::SHOW_RELATED => true,
                self::SHOW_SELF => true,
                self::SHOW_DATA => isset($includeRelationships['patients']),
                self::DATA => function () use ($nutritionist) {
                    return $nutritionist->patients;
                }
            ]
        ];
    }
}
