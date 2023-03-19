<?php
namespace App\Http\Requests\Home;

use App\Http\Requests\BaseRequest;

class LoginPostRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [ 'required', 'email' ],
            'password' => [ 'required', 'string' ]
        ];
    }
}
