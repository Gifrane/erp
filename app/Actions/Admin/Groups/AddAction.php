<?php

namespace App\Actions\Admin\Groups;

use App\Models\Group\Group;

use Illuminate\Support\Facades\Log;

use function __;
use function is_null;

class AddAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $group = Group::where('name', $params['name'])->first();

            if (!is_null($group)) {
                return [ 'success' => false, 'status' => 422, 'errors' => [ __('admin_groups.group_already_exists') ] ];
            }

            $group = new Group();
            $group->name = $params['name'];
            $group->save();

            return [ 'success' => true, 'data' => $group->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }
}
