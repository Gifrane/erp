<?php

namespace App\Http\Requests\User\Settings;

use App\Http\Requests\BaseRequest;

class SendEmailResetPasswordRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
