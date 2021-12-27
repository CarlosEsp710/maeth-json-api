<?php

namespace App\JsonApi\Nutritionists;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{
    protected $fillable = [
        'phone_number',
        'address',
        'description',
        'curriculum',
        'identification_card',
        'specializations',
        'user'
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
        parent::__construct(new \App\Models\Nutritionist(), $paging);
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

    public function fillAttributes($nutritionist, Collection $attributes)
    {
        $nutritionist->fill($attributes->only($this->fillable)->toArray());
    }

    public function user()
    {
        return $this->belongsTo();
    }

    public function patients()
    {
        return $this->hasManyThrough();
    }
}
