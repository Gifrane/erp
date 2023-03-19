<?php

namespace App\Actions\Home;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use function __;
use function auth;

class LoginPostAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $params_auth = [];
            $params_auth['email'] = $params['email'];
            $params_auth['password'] = $params['password'];

            if (Auth::attempt($params_auth)) {
                return [ 'success' => true ];
            }

            return [ 'success' => false, 'errors' => [ __('home.auth.login.failed_connection') ] ];
        } catch (\Exception $e) {
            Log::error($e);

            if (auth()->check() && !empty(auth()->user()->session_id)) {
                Cache::forget('auth_'.auth()->user()->session_id.'_last_activity');
            }

            auth()->logout();

            return [ 'success' => false, 'errors' => [ __('home.auth.login.error_during_login') ] ];
        }
    }
}
