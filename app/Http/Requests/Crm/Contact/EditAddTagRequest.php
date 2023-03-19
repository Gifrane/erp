<?php
namespace App\Http\Requests\Crm\Contact;

use App\Http\Requests\BaseRequest;

class EditAddTagRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'tag' => [ 'required', 'string' ]
        ];
    }
}
