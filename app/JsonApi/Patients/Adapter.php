<?php

namespace App\JsonApi\Patients;

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
        'scholarship',
        'occupation',
        'height',
        'weight',
        'user',
        'nutritionist'
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
        parent::__construct(new \App\Models\Patient(), $paging);
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

    public function fillAttributes($patient, Collection $attributes)
    {
        $patient->fill($attributes->only($this->fillable)->toArray());
    }

    public function user()
    {
        return $this->belongsTo();
    }

    public function nutritionist()
    {
        return $this->belongsTo();
    }
}
