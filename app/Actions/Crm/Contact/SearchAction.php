<?php

namespace App\Actions\Crm\Contact;

use App\Models\Bookmark;
use App\Models\Crm\CrmContact;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function auth;

class SearchAction
{
    const FILTERS = [
        'company' => 'companyFilter',
        'group' => 'groupFilter'
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

            $query = CrmContact::where('account_id', app()->account->id)
                ->select(
                    DB::raw('CAST(crm_contact.id AS string) AS id'),
                    'lastname', 'firstname', 'email', 'phone', 'i18n_country_id',
                    'created_at'
                );

            foreach ($vars['filters'] as $filter) {
                $this->{ self::FILTERS[ $filter['filter'] ] }($query, $filter);
            }

            $query->when($vars['order_column'] === 'name', function ($query2) use ($vars) {
                $query2->orderBy('firstname', $vars['order_order'])->orderBy('lastname', $vars['order_order']);
            })->when($vars['order_column'] !== 'name', function ($query2) use ($vars) {
                $query2->orderBy($vars['order_column'], $vars['order_order']);
            });

            $data = $query->paginate($vars['per_page'], ['*'], 'page', $vars['page'])->toArray();

            foreach ($data['data'] as &$item) {
                $item['created_at'] = Carbon::parse($item['created_at'])->setTimezone($user->timezone)->toDateTimeString();
            }

            $data['bookmarks'] = Bookmark::select('entity_id')->where('entity_type', 'crm_contact')
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
    private function companyFilter($query, array $filter): void
    {
        if ($filter['operator'] === 'is_in') {
            $query->whereHas('companies', function ($query2) use ($filter) {
                $query2->whereIn('crm_company.id', $filter['value']);
            });
        }
    }

    /**
     * @param $query
     * @param array $filter
     * @return void
     */
    private function groupFilter($query, array $filter): void
    {
        if ($filter['operator'] === 'is_in') {
            $query->whereHas('groups', function ($query2) use ($filter) {
                $query2->whereIn('crm_group.id', $filter['value']);
            });
        }
    }
}
