<?php

namespace App\Actions\Admin\Users;

use App\Models\User\User;
use App\Models\User\UserModule;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function in_array;
use function is_null;

class EditModulesAction
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
                return [ 'success' => false, 'status' => 404, 'errors' => [ __('general.error_during_update') ] ];
            }

            $user_modules = $params['modules'] ?? [];
            $current_modules = UserModule::where('user_id', $user->id)->select('module_id')->get()->pluck('module_id')->toArray();

            foreach ($current_modules as $cm) {
                if (!in_array($cm, $user_modules)) {
                    UserModule::where('user_id', $user->id)->where('module_id', $cm)->delete();
                }
            }

            foreach ($user_modules as $um) {
                if (!in_array($um, $current_modules)) {
                    $user_module = new UserModule();
                    $user_module->account_id = $account_id;
                    $user_module->user_id = $user->id;
                    $user_module->module_id = $um;
                    $user_module->save();
                }
            }

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_update') ] ];
        }
    }
}
