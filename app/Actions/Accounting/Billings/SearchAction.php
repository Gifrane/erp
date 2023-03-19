<?php

namespace App\Actions\Accounting\Billings;

use App\Models\Bookmark;
use App\Models\Accounting\Billing\Billing;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use function auth;
use function collect;

class SearchAction
{
    const FILTERS = [
        'title' => 'titleFilter'
    ];

    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $user = auth()->user();

            $vars = $params + [ 'filters' => [] ];

            $billings = Billing::when(!empty($vars['filters']), function ($query2) use ($vars) {
                foreach ($vars['filters'] as $filter) {
                    $this->{ self::FILTERS[ $filter['filter'] ] }($query2, $filter);
                }
            })
                ->orderBy($vars['order_column'], $vars['order_order'])
                ->paginate($vars['per_page'], ['*'], 'page', $vars['page']);

            $data = $billings->toArray();

            foreach ($data['data'] as &$item) {
                $item['created_at'] = Carbon::parse($item['created_at'])->setTimezone($user->timezone)->toDateTimeString();
            }

            $data['bookmarks'] = Bookmark::select('entity_id')->where('entity_type', 'accounting_billing')
                ->whereIn('entity_id', collect($data['data'])->pluck('id')->toArray())
                ->where('user_id', $user->id)
                ->get()->pluck('entity_id')->toArray();

            return [ 'success' => true, 'data' => $data ];
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
    private function titleFilter($query, array $filter): void
    {
        if ($filter['operator'] === 'is') {
            $query->where('title', $filter['value']);
        } elseif ($filter['operator'] === 'contains') {
            $query->where('title', 'LIKE', '%'.$filter['value'].'%');
        } elseif ($filter['operator'] === 'is_not') {
            $query->where('title', '!=', $filter['value']);
        } elseif ($filter['operator'] === 'not_contains') {
            $query->where('title', 'NOT LIKE', '%'.$filter['value'].'%');
        }
    }
}
