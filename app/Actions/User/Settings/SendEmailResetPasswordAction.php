<?php

namespace App\Actions\User\Settings;

use App\Mail\SendEmailResetPassword;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use function __;
use function auth;
use function config;

class SendEmailResetPasswordAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $user = auth()->user();

            if (config('app.env') !== 'testing') {
                Mail::to($user->email)->send(new SendEmailResetPassword($user, app()->account));
            }

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}
