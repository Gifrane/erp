<?php

namespace App\Actions\Admin\Users;

use App\Mail\EnableAccount;
use App\Models\User\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use function __;
use function app;
use function config;
use function is_null;

class ResendEnableMailAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $account = app()->account;

            $user = User::where('account_id', $account->id)->where('id', $params['user'])
                ->select('id', 'email', 'firstname', 'lastname')->first();

            if (is_null($user)) {
                return [ 'success' => false, 'status' => 404, 'errors' => [ __('admin_users.user_not_found') ] ];
            }

            if (config('app.env') !== 'testing') {
                Mail::to($user->email)->send(new EnableAccount($user, $account));
            }

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('admin_users.resend_enable_mail.error_during_sending') ] ];
        }
    }
}
