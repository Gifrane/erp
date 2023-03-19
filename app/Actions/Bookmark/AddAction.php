<?php

namespace App\Actions\Bookmark;

use App\Models\Bookmark;

use function __;
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
            $user_id = auth()->id();

            $check = Bookmark::where('user_id', $user_id)->where('entity_type', $params['entity_type'])
                ->where('entity_id', $params['entity_id'])
                ->count();

            if ($check > 0) {
                return [ 'success' => true ];
            }

            $bookmark = new Bookmark();
            $bookmark->user_id = $user_id;
            $bookmark->entity_type = $params['entity_type'];
            $bookmark->entity_id = $params['entity_id'];
            $bookmark->save();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            return [ 'success' => false, 'status' => 500, 'errors' => [ __('bookmark.error_during_add') ] ];
        }
    }
}
