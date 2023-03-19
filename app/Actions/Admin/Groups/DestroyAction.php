<?php

namespace App\Actions\Admin\Groups;

use App\Models\Group\Group;

use Illuminate\Support\Facades\Log;

use function __;
use function is_null;

class DestroyAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $group = Group::where('id', $params['group'])->first();

            if (is_null($group)) {
                return [ 'success' => false, 'status' => 404, 'errors' => [ __('admin_groups.group_not_found') ] ];
            }

            $group->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_deletion') ] ];
        }
    }
}
