<?php

namespace App\JsonApi\Patients;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;
use CloudCreativity\LaravelJsonApi\Rules\HasOne;
use Illuminate\Validation\Rule;

class Validators extends AbstractValidators
{

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = ['nutritionist'];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = [];

    /**
     * The filters a client is allowed send.
     *
     * @var string[]|null
     *      the allowed filters, an empty array for none allowed, or null to allow all.
     */
    protected $allowedFilteringParameters = [];

    /**
     * Get resource validation rules.
     *
     * @param mixed|null $record
     *      the record being updated, or null if creating a resource.
     * @param array $data
     *      the data being validated
     * @return array
     */
    protected function rules($record, array $data): array
    {
        return [
            'phone_number' => ['required'],
            'address' => ['required'],
            'scholarship' => ['required'],
            'occupation' => ['required'],
            'description' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'user' => [
                Rule::requiredIf(!$record),
                new HasOne('users'),
            ],
            'nutritionist' => [
                Rule::requiredIf(!$record),
                new HasOne('users')
            ],
        ];
    }

    /**
     * Get query parameter validation rules.
     *
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            //
        ];
    }
}
