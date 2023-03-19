<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\User\User\ProcessEnableTokenPostRequest;
use App\Models\Account\Account;
use App\Models\User\User;
use App\Models\User\UserSession;
use App\Services\TokenEncryption;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

use function base64_encode;
use function json_decode;
use function json_encode;
use function now;
use function rand;
use function redirect;
use function view;

class UserController extends BaseController
{
    protected string $actionsPath = 'App\Actions\User\User';
    protected string $requestsPath = 'App\Http\Requests\User\User';

    public function processEnableTokenGet(string $token)
    {
        $params = json_decode(TokenEncryption::decrypt($token), true);

        $account = Account::where('id', $params['account_id'])->firstOrFail();
        $user = User::where('id', $params['user_id'])->where('account_id', $account->id)->firstOrFail();

        return view('user.process_enable_account', [
            'account' => $account, 'user' => $user
        ]);
    }

    /**
     * @param ProcessEnableTokenPostRequest $request
     */
    public function processEnableTokenPost(ProcessEnableTokenPostRequest $request)
    {
        $params = $request->validated();

        $params_token = json_decode(TokenEncryption::decrypt($params['token']), true);

        $account = Account::where('id', $params_token['account_id'])->firstOrFail();
        $user = User::where('id', $params_token['user_id'])->where('account_id', $account->id)->firstOrFail();

        $user->firstname = $params['firstname'];
        $user->lastname = $params['lastname'];
        $user->email = $params['email'];
        $user->password = Hash::make($params['password'], [ 'memory' => 1024, 'time' => 2, 'threads' => 2 ]);
        $user->active = true;
        $user->enabled_at = now();
        $user->save();

        $session_id = base64_encode(now().'|'.$user->id.'|'.rand(100, 999));

        $session = new UserSession();
        $session->user_id = $user->id;
        $session->session_id = $session_id;
        $session->save();

        $token = TokenEncryption::encrypt(json_encode([
            'account_id' => $account->id, 'user_id' => $user->id, 'session_id' => $session_id
        ]));

        Cache::put('auth_'.$session_id.'_last_activity', now());
        Cookie::queue('user_app_token', $token);

        return redirect('/');
    }
}