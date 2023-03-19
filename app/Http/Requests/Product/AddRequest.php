<?php

namespace App\Http\Requests\Product;

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
            'price_before_tax' => [ 'required', 'numeric' ],
            'price_with_tax' => [ 'required', 'numeric' ],
            'tva' => [ 'required', 'numeric' ],
        ];
    }
}
