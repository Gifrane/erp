<?php

namespace App\Http\Requests\Product\SpareParts;

use App\Http\Requests\BaseRequest;

class AddRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [ 'required', 'string' ],
            'provider' => [ 'required', 'array' ],
            'manufacturer' => [ 'required', 'array' ],
            'unit_cost' => [ 'required', 'numeric' ],
            'amount' => [ 'required', 'numeric' ],
        ];
    }
}
