<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\BaseRequest;

class DetailsRequest extends BaseRequest
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
            'user' => [ 'required', 'integer' ]
        ];
    }
}
