<?php
namespace App\Http\Requests\Crm\Contact;

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
            'email' => [ 'required', 'string' ],
            'country' => [ 'sometimes', 'nullable', 'integer' ],
            'companies' => [ 'sometimes', 'array' ],
            'groups' => [ 'sometimes', 'array' ],
            'phone' => [ 'sometimes', 'nullable', 'string' ]
        ];
    }
}
