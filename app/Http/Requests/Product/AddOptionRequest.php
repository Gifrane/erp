<?php
namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class AddOptionRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [ 'required', 'string' ],
            'price' => [ 'sometimes', 'nullable', 'numeric' ]
        ];
    }
}
