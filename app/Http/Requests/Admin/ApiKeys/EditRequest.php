<?php

namespace App\Http\Requests\Admin\ApiKeys;

use App\Http\Requests\BaseRequest;

class EditRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'keys' => $this->route('keys') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'keys' => [ 'required', 'integer' ],
            'name' => [ 'required', 'string' ],
            'public_key' => [ 'required', 'string' ],
            'private_key' => [ 'required', 'string' ],
            'expired_at' => [ 'sometimes', 'nullable', 'string' ],
            'modules' => [ 'sometimes', 'nullable', 'array' ],
        ];
    }
}
