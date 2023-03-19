<?php

namespace App\Actions\User\Settings;

use App\Models\User\UserSetting;

use Illuminate\Support\Facades\Log;

use function __;
use function auth;

class DetailsAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $user = auth()->user();

            $user_settings = UserSetting::where('user_id', $user->id)->whereIn('setting', [
                'enable_mail_notification'
            ])->get()->pluck('value', 'setting');

            return [
                'success' => true,
                'data' => [
                    'enable_mail_notification' => $user_settings->get('enable_mail_notification', false),
                ]
            ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}
