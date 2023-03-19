<?php

namespace App\Actions\Admin\Users;

use App\Models\User\User;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function is_null;

class EditAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $user = User::where('account_id', app()->account->id)->where('id', $params['user'])->first();

            if (is_null($user)) {
                return [ 'success' => false, 'status' => 404, 'errors' => [ __('general.error_during_update') ] ];
            }

            $user->email = $params['email'];
            $user->firstname = $params['firstname'];
            $user->lastname = $params['lastname'];
            $user->role = $params['role'] ?? null;
            $user->save();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_update') ] ];
        }
    }
}
