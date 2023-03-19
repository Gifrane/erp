<?php
namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class DeleteOptionRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer' ]
        ];
    }
}
