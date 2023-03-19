<?php
namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class DetailsRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'product' => $this->route('product') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'product' => [ 'required', 'integer' ],
            'relations' => [ 'sometimes', 'array' ]
        ];
    }
}
