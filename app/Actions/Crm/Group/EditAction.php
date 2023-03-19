<?php

namespace App\Actions\Crm\Group;

use function app;

class EditAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $group = app()->group;
            $group->name = $params['name'];
            $group->save();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('crm.groups.edit.error_during_update', 500, $e);
        }
    }
}
