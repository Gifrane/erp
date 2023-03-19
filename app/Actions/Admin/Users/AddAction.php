<?php

namespace App\Actions\Admin\Users;

use App\Mail\EnableAccount;
use App\Models\User\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use function __;
use function auth;
use function config;
use function is_null;

class AddAction
{
    const DEFAULT_AVATAR = 'upl/default_picture.jpg';

    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $current_user = auth()->user();

            $user = User::where('email', $params['email'])->first();

            if (!is_null($user)) {
                return [ 'success' => false, 'status' => 422, 'errors' => [ __('admin_users.user_already_exists') ] ];
            }

            $user = new User();
            $user->company_id = $current_user->company_id;
            $user->email = $params['email'];
            $user->password = 'null';
            $user->firstname = $params['firstname'];
            $user->lastname = $params['lastname'];
            $user->avatar = self::DEFAULT_AVATAR;
            $user->i18n_country_id = $current_user->i18n_country_id;
            $user->lang = $current_user->lang;
            $user->timezone = $current_user->timezone;
            $user->date_format = 'YYYY-MM-DD';
            $user->save();

            if (config('app.env') !== 'testing') {
                try {
                    Mail::to($params['email'])->send(new EnableAccount($user));
                } catch (\Throwable $e) {
                    Log::error($e);
                }
            }

            return [ 'success' => true, 'data' => $user->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }
}
