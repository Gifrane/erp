<?php

namespace App\Http\Requests\Supplier;

use App\Http\Requests\BaseRequest;

class DestroyRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'supplier' => $this->route('supplier') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'supplier' => [ 'required', 'integer' ],
        ];
    }
}
