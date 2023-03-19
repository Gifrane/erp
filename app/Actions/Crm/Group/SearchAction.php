<?php

namespace App\Actions\Crm\Group;

use App\Models\Bookmark;
use App\Models\Crm\CrmGroup;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function auth;
use function collect;

class SearchAction
{
    const FILTERS = [
        'name' => 'nameFilter'
    ];

    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $vars = $params + [ 'filters' => [] ];

            $query = CrmGroup::withCount('contacts')->with([ 'creator' ])->where('account_id', app()->account->id);

            foreach ($vars['filters'] as $filter) {
                $this->{ self::FILTERS[ $filter['filter'] ] }($query, $filter);
            }

            $groups = $query->orderBy($vars['order_column'], $vars['order_order'])
                ->paginate($vars['per_page'], ['*'], 'page', $vars['page']);

            $data = $groups->toArray();

            $data['bookmarks'] = Bookmark::select('entity_id')->where('entity_type', 'crm_group')
                ->whereIn('entity_id', collect($data['data'])->pluck('id')->toArray())
                ->where('user_id', auth()->id())
                ->get()->pluck('entity_id')->toArray();

            return [ 'success' => true, 'data' => $data ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => true, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }

    /**
     * @param $query
     * @param array $filter
     * @return void
     */
    private function nameFilter($query, array $filter): void
    {
        if ($filter['operator'] === 'is') {
            $query->where('name', $filter['value']);
        } elseif ($filter['operator'] === 'contains') {
            $query->where('name', 'LIKE', '%'.$filter['value'].'%');
        } elseif ($filter['operator'] === 'is_not') {
            $query->where('name', '!=', $filter['value']);
        } elseif ($filter['operator'] === 'not_contains') {
            $query->where('name', 'NOT LIKE', '%'.$filter['value'].'%');
        }
    }
}
