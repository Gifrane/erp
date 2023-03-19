<?php
namespace App\Http\Requests\Crm\Group;

use App\Http\Requests\BaseRequest;

class AddRequest extends BaseRequest
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
