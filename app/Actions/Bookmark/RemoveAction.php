<?php

namespace App\Actions\Bookmark;

use App\Models\Bookmark;

use function __;
use function auth;
use function is_null;

class RemoveAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $userId = auth()->id();

            $bookmark = Bookmark::where('user_id', $userId)->where('entity_type', $params['entity_type'])
                ->where('entity_id', $params['entity_id'])
                ->first();

            if (is_null($bookmark)) {
                return [ 'success' => true ];
            }

            $bookmark->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            return [ 'success' => false, 'status' => 500, 'errors' => [ __('bookmark.error_during_delete') ] ];
        }
    }
}
