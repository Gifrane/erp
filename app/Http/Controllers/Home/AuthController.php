<?php
namespace App\Http\Controllers\Home;

use App\Actions\Home\LoginPostAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Home\LoginPostRequest;

use Illuminate\Support\Facades\Cache;

use function app;
use function redirect;
use function route;
use function view;

class AuthController extends BaseController
{
    public function loginGet()
    {
        return view('home.login');
    }

    /**
     * @param LoginPostRequest $request
     */
    public function loginPost(LoginPostRequest $request)
    {
        $action = app(LoginPostAction::class)->execute($request->validated());

        if ($action['success']) {
            return redirect()->route('app');
        }

        if (!empty($action['errors']) && $action['errors'][0] === 'client_not_exists') {
            return redirect()->away('https://gifrane.com');
        }

        return redirect(route('auth.login.get').'?login=failed')->with('errors', $action['errors']);
    }

    public function logout()
    {
        if (auth()->check() && !empty(auth()->user()->session_id)) {
            Cache::forget('auth_'.auth()->user()->session_id.'_last_activity');
        }

        auth()->logout();

        return redirect()->route('auth.login.get');
    }
}
