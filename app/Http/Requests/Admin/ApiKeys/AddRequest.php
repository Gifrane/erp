<?php

namespace App\Http\Requests\Admin\ApiKeys;

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
            'expired_at' => [ 'sometimes', 'nullable', 'string' ],
            'modules' => [ 'sometimes', 'nullable', 'array' ],
        ];
    }
}
