<?php

namespace App\Http\Requests\User\Settings;

use App\Http\Requests\BaseRequest;

class UpdateI18nRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'country' => [ 'required', 'integer' ],
            'lang' => [ 'required', 'string' ],
            'timezone' => [ 'required', 'string' ],
        ];
    }
}
