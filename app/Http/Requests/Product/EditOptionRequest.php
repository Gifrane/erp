<?php
namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class EditOptionRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer' ],
            'name' => [ 'required', 'string' ],
            'price' => [ 'sometimes', 'nullable', 'numeric' ]
        ];
    }
}
