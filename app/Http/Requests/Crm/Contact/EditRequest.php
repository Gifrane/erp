<?php
namespace App\Http\Requests\Crm\Contact;

use App\Http\Requests\BaseRequest;

class EditRequest extends BaseRequest
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
            'companies' => [ 'sometimes', 'array' ],
            'groups' => [ 'sometimes', 'array' ],
            'country' => [ 'sometimes', 'nullable', 'integer' ],
            'tags' => [ 'sometimes', 'array' ],
            'phone' => [ 'sometimes', 'nullable', 'string' ]
        ];
    }
}
