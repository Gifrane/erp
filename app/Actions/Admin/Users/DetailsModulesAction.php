<?php

namespace App\Actions\Admin\Users;

use App\Models\Module;
use App\Models\Account\AccountModule;
use App\Models\User\User;
use App\Models\User\UserModule;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function in_array;
use function is_null;

class DetailsModulesAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $account_id = app()->account->id;

            $user = User::where('account_id', $account_id)->where('id', $params['user'])->first();

            if (is_null($user)) {
                return [ 'success' => false, 'status' => 404, 'errors' => [ __('admin_users.user_not_found') ] ];
            }

            $user_modules = UserModule::where('user_id', $user->id)->select('module_id')->get()->pluck('module_id');

            $account_modules = AccountModule::where('account_id', $account_id)->select('module_id')->get()->pluck('module_id');
            $list_modules = Module::whereIn('id', $account_modules->toArray())->linkable()->select('id', 'name')->get();

            $list_pluck = $list_modules->pluck('id')->toArray();

            $data = [];
            $data['user'] = $user;

            $data['user_modules'] = $user_modules->filter(function ($mod) use ($list_pluck) {
                return in_array($mod, $list_pluck);
            })->values()->toArray();

            $data['account_modules'] = $account_modules->filter(function ($mod) use ($list_pluck) {
                return in_array($mod, $list_pluck);
            })->values()->toArray();

            $data['list_modules'] = $list_modules->toArray();

            return [ 'success' => true, 'data' => $data ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}
