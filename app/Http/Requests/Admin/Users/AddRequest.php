<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\BaseRequest;

class AddRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => [ 'required', 'string' ],
            'lastname' => [ 'required', 'string' ],
            'email' => [ 'required', 'email' ],
        ];
    }
}
