<?php

namespace App\JsonApi\Patients;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'patients';

    /**
     * @param \App\Patient $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Patient $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($patient)
    {
        return [
            'phone_number' => $patient->phone_number,
            'address' => $patient->address,
            'scholarship' => $patient->scholarship,
            'occupation' => $patient->occupation,
            'description' => $patient->description,
            'weight' => $patient->weight,
            'height' => $patient->height,
        ];
    }

    public function getRelationships($patient, $isPrimary, array $includeRelationships)
    {

        return [
            'nutritionist' => [
                self::SHOW_RELATED => true,
                self::SHOW_SELF => true,
                self::SHOW_DATA => isset($includeRelationships['nutritionist']),
                self::DATA => function () use ($patient) {
                    return $patient->nutritionist;
                }
            ]
        ];
    }
}
