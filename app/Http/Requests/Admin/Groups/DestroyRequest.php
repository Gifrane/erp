<?php
namespace App\Http\Requests\Admin\Groups;

use App\Http\Requests\BaseRequest;

class DestroyRequest extends BaseRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([ 'group' => $this->route('group') ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'group' => [ 'required', 'integer' ]
        ];
    }
}
