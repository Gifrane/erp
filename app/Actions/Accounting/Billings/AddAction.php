<?php

namespace App\Actions\Accounting\Billings;

use App\Models\Accounting\Billing\Billing;

use Illuminate\Support\Facades\Log;

use function __;
use function auth;
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
            $billing_id = 1;

            $last_billing = Billing::orderBy('id', 'DESC')->first();

            if (!is_null($last_billing)) {
                $billing_id = (int) $last_billing->billing_id + 1;
            }

            $billing = new Billing();
            $billing->creator_id = auth()->id();
            $billing->billing_id = $billing_id;
            $billing->title = $params['title'];
            $billing->direction = $params['direction'];
            $billing->step = $params['step'];
            $billing->amount_ht = $params['amount_ht'];
            $billing->amount_ttc = $params['amount_ttc'];
            $billing->emitted_at = $params['emitted_at'] ?? null;
            $billing->completed_at = $params['completed_at'] ?? null;
            $billing->receiver = $params['receiver']['string'] ?? null;
            $billing->emitter = $params['emitter']['string'] ?? null;
            $billing->save();

            return [ 'success' => true, 'data' => $billing->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }
}
