<?php

namespace App\Actions\Supplier;

use App\Models\Supplier\Supplier;

use Illuminate\Support\Facades\Log;

use function __;
use function app;

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

            $query = Supplier::where('account_id', app()->account->id);

            foreach ($vars['filters'] as $filter) {
                $this->{ self::FILTERS[ $filter['filter'] ] }($query, $filter);
            }

            $suppliers = $query->orderBy($vars['order_column'], $vars['order_order'])
                ->when(!empty($vars['search']), function ($query) use ($vars) {
                    $query->where('name', 'ILIKE', '%'.$vars['search'].'%');
                })
                ->paginate($vars['per_page'], ['*'], 'page', $vars['page']);

            return [ 'success' => true, 'data' => $suppliers->toArray() ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
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
