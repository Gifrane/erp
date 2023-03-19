<?php

namespace App\Actions\Crm\Group;

use App\Models\Crm\CrmGroup;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function auth;

class AddAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $group = new CrmGroup();
            $group->account_id = app()->account->id;
            $group->source = 'app';
            $group->name = $params['name'];
            $group->creator_id = auth()->id();
            $group->save();

            return [ 'success' => true, 'data' => $group->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }
}
