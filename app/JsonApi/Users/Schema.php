<?php

namespace App\JsonApi\Users;

use App\Models\User;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

    /**
     * @param \App\Models\User $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Models\User $user
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($user)
    {
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'image_profile' => $user->image_profile,
            'birthday' => $user->birthday,
            'gender' => $user->gender,
            'user_type' => $user->type,
            'validation' => $user->verified,
            'status' => $user->status
        ];
    }

    public function getRelationships($user, $isPrimary, array $includeRelationships)
    {
        if ($user->type == User::NUTRITIONIST) {
            return [
                'nutritionistProfile' => [
                    self::SHOW_RELATED => true,
                    self::SHOW_SELF => true,
                    self::SHOW_DATA => isset($includeRelationships['nutritionistProfile']),
                    self::DATA => function () use ($user) {
                        return $user->nutritionistProfile;
                    }
                ],
                'articles' => [
                    self::SHOW_RELATED => true,
                    self::SHOW_SELF => true,
                    self::SHOW_DATA => isset($includeRelationships['articles']),
                    self::DATA => function () use ($user) {
                        return $user->articles;
                    }
                ]
            ];
        }

        if ($user->type == User::PATIENT) {
            return [
                'patientProfile' => [
                    self::SHOW_RELATED => true,
                    self::SHOW_SELF => true,
                    self::SHOW_DATA => isset($includeRelationships['patientProfile']),
                    self::DATA => function () use ($user) {
                        return $user->patientProfile;
                    }
                ],
                'articles' => [
                    self::SHOW_RELATED => true,
                    self::SHOW_SELF => true,
                    self::SHOW_DATA => isset($includeRelationships['articles']),
                    self::DATA => function () use ($user) {
                        return $user->articles;
                    }
                ]
            ];
        }

        return [];
    }
}
