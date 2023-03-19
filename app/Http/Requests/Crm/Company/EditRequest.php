<?php

namespace App\Http\Requests\Crm\Company;

use App\Http\Requests\BaseRequest;

class EditRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [ 'required', 'string' ],
            'country' => [ 'required', 'string' ],
            'city' => [ 'sometimes', 'nullable', 'string' ],
            'website' => [ 'sometimes', 'nullable', 'string' ],
            'interval' => [ 'sometimes' ],
            'annual_revenues' => [ 'sometimes', 'nullable', 'integer' ],
            'description' => [ 'sometimes', 'nullable', 'string' ],
            'tags' => [ 'sometimes', 'json' ],
            'postal_address' => [ 'sometimes', 'nullable', 'string' ],
            'postal_code' => [ 'sometimes', 'nullable', 'string' ],
        ];
    }
}
