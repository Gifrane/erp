<?php

namespace App\Actions\Admin\ApiKeys;

use App\Models\ApiKeys;

use Illuminate\Support\Facades\Log;

use function __;
use function auth;
use function base64_encode;
use function rand;
use function sha1;

class AddAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $keys = new ApiKeys();
            $keys->generated_by_user_id = auth()->id();
            $keys->name = $params['name'];
            $keys->expired_at = $params['expired_at'] ?? null;
            $keys->public_key = $this->generateKey();
            $keys->private_key = $this->generateKey();
            $keys->modules = $params['modules'] ?? [];
            $keys->save();

            return [ 'success' => true, 'data' => $keys ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }

    /**
     * @return string
     */
    private function generateKey(): string
    {
        return sha1(base64_encode(rand(500, 999999999).rand(99999, 541878211)));
    }
}
