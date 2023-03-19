<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

use Illuminate\Validation\Rule;

class EditRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'product' => $this->route('product') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'product' => [ 'required', 'integer' ],
            'name' => [ 'required', 'string' ],
            'family' => [ 'sometimes', 'nullable', 'string' ],
            'company' => [ 'sometimes', 'nullable', 'string' ],
            'price_before_tax' => [ 'required', 'numeric' ],
            'price_with_tax' => [ 'required', 'numeric' ],
            'tva' => [ 'required', 'numeric', 'max:99.99' ],
            'subscription_period' => [ 'sometimes', 'nullable', Rule::in([ 'day', 'week', 'month', 'year' ]) ],
            'started_at' => [ 'sometimes', 'nullable', 'date' ],
            'stopped_at' => [ 'sometimes', 'nullable', 'date' ]
        ];
    }
}
