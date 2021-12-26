<?php

namespace App\JsonApi\Articles;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category',
        'author'
    ];

    protected $includePaths = [
        'author' => 'user'
    ];

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Mapping of JSON API filter names to model scopes.
     *
     * @var array
     */
    protected $filterScopes = [];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new \App\Models\Article(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        $this->filterWithScopes($query, $filters);
    }

    public function fillAttributes($article, Collection $attributes)
    {
        $article->fill($attributes->only($this->fillable)->toArray());
    }

    public function author()
    {
        return $this->belongsTo('user');
    }

    public function category()
    {
        return $this->belongsTo();
    }
}
