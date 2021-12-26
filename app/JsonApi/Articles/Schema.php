<?php

namespace App\JsonApi\Articles;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'articles';

    /**
     * @param \App\Article $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Article $article
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($article)
    {
        return [
            'title' => $article->title,
            'slug' => $article->slug,
            'image' => $article->image,
            'content' => $article->content,
        ];
    }

    public function getRelationships($article, $isPrimary, array $includeRelationships)
    {

        return [
            'author' => [
                self::SHOW_RELATED => true,
                self::SHOW_SELF => true,
                self::SHOW_DATA => isset($includeRelationships['author']),
                self::DATA => function () use ($article) {
                    return $article->user;
                }
            ],
            'category' => [
                self::SHOW_RELATED => true,
                self::SHOW_SELF => true,
                self::SHOW_DATA => isset($includeRelationships['category']),
                self::DATA => function () use ($article) {
                    return $article->category;
                }
            ]
        ];
    }
}
