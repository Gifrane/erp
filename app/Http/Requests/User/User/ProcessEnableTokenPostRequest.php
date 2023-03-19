<?php
namespace App\Http\Requests\User\User;

use App\Http\Requests\BaseRequest;

class ProcessEnableTokenPostRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'token' => $this->route('token') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'token' => [ 'required', 'string' ],
            'firstname' => [ 'required', 'string' ],
            'lastname' => [ 'required', 'string' ],
            'email' => [ 'required', 'email' ],
            'password' => [ 'required', 'string' ]
        ];
    }
}
