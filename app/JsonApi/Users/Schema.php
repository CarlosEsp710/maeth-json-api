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
            'name' => "{$user->first_name} {$user->last_name}",
            'email' => $user->email,
            'user_type' => $user->type,
            'status' => $user->verified,
        ];
    }

    public function getRelationships($user, $isPrimary, array $includeRelationships)
    {
        return [
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
}
