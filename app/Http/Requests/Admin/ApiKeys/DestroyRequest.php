<?php
namespace App\Http\Requests\Admin\ApiKeys;

use App\Http\Requests\BaseRequest;

class DestroyRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'keys' => $this->route('keys') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'keys' => [ 'required', 'integer' ]
        ];
    }
}
