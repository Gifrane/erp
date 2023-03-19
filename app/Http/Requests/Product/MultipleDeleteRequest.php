<?php
namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class MultipleDeleteRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'products' => [ 'required', 'array' ]
        ];
    }
}
