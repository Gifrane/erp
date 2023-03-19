<?php
namespace App\Http\Requests\Admin\Groups;

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
