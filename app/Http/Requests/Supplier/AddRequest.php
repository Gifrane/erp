<?php

namespace App\Http\Requests\Supplier;

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
            'is_manufacturer' => [ 'required', 'boolean' ],
            'is_provider' => [ 'required', 'boolean' ],
        ];
    }
}
