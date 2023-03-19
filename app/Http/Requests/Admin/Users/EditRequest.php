<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\BaseRequest;

class EditRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'user' => $this->route('user') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'user' => [ 'required', 'integer' ],
            'email' => [ 'required', 'string' ],
            'firstname' => [ 'required', 'string' ],
            'lastname' => [ 'required', 'string' ],
            'role' => [ 'sometimes', 'nullable', 'string' ],
        ];
    }
}
