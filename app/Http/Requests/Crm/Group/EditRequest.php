<?php
namespace App\Http\Requests\Crm\Group;

use App\Http\Requests\BaseRequest;

class EditRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [ 'required', 'string' ]
        ];
    }
}
