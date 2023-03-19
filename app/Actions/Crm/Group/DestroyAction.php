<?php

namespace App\Actions\Crm\Group;

use Illuminate\Support\Facades\DB;

use function app;

class DestroyAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $group = app()->group;

            DB::table('crm_contact_group')->where('crm_group_id', $group->id)->delete();

            $group->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('crm.groups.destroy.error_during_delete', 500, $e);
        }
    }
}
