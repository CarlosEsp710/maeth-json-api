<?php

namespace App\JsonApi\Reports;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    protected $fillable = [
        'clinical_indicators',
        'family_background',
        'gynecological_history',
        'life_style',
        'daily_routine',
        'dietary_indicators',
        'food_characteristics',
        'consumption_variants',
        'usual_diet',
        'patient',
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
        parent::__construct(new \App\Models\Report(), $paging);
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

    public function fillAttributes($report, Collection $attributes)
    {
        $report->fill($attributes->only($this->fillable)->toArray());
    }

    public function patient()
    {
        return $this->belongsTo();
    }
}
