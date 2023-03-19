<?php

namespace App\Actions\Admin\Users;

use App\Models\User\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function auth;

class SearchAction
{
    const FILTERS = [];

    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $vars = $params + [ 'filters' => [] ];

            $timezone = auth()->user()->timezone;

            $query = User::where('account_id', app()->account->id)
                ->orderBy($vars['order_column'], $vars['order_order']);

            foreach ($vars['filters'] as $filter) {
                $this->{ self::FILTERS[ $filter['filter'] ] }($query, $filter);
            }

            $users = $query->paginate($vars['per_page'], ['*'], 'page', $vars['page'])->toArray();

            foreach ($users['data'] as &$item) {
                unset($item['password']);

                $item['created_at'] = Carbon::parse($item['created_at'])->setTimezone($timezone)->toDateString();
            }

            return [ 'success' => true, 'data' => $users ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}
