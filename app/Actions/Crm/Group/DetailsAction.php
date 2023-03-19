<?php
namespace App\Actions\Crm\Group;

use function app;

class DetailsAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $group = app()->group;

            return [ 'success' => true, 'data' => $group ];
        } catch (\Exception $e) {
            throw new \Exception('crm.groups.details.error_during_retrieving', 500, $e);
        }
    }
}
