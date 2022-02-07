<?php

namespace App\JsonApi\Reports;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'reports';

    /**
     * @param \App\Report $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Report $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($report)
    {
        return [
            'clinical_indicators' => $report->clinical_indicators,
            'family_background' => $report->family_background,
            'gynecological_history' => $report->gynecological_history,
            'life_style' => $report->life_style,
            'daily_routine' => $report->daily_routine,
            'dietary_indicators' => $report->dietary_indicators,
            'food_characteristics' => $report->food_characteristics,
            'consumption_variants' => $report->consumption_variants,
            'usual_diet' => $report->usual_diet,
        ];
    }
}
