<?php

namespace App\Actions\Crm\Contact;

use App\Models\Tag;
use App\Models\TagLink;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use function app;
use function is_null;

class EditAddTagAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $account_id = app()->account->id;
            $contact = app()->contact;

            $tag = Tag::where('account_id', $account_id)->where('name', $params['tag'])->first();

            if (is_null($tag)) {
                $tag = new Tag();
                $tag->account_id = $account_id;
                $tag->name = $params['tag'];
                $tag->module = 'crm_contact';
                $tag->save();
            }

            $tagLink = DB::table('tag_link')->where('account_id', $account_id)
                ->where('tag_id', $tag->id)->where('entity_type', 'crm_contact')
                ->where('entity_id', $contact->id)
                ->first();

            if (is_null($tagLink)) {
                $tagLink = new TagLink();
                $tagLink->account_id = $account_id;
                $tagLink->tag_id = $tag->id;
                $tagLink->entity_type = 'crm_contact';
                $tagLink->entity_id = $contact->id;
                $tagLink->save();
            }

            return [
                'success' => true,
                'data' => [ 'id' => $tag->id, 'name' => $tag->name ]
            ];
        } catch (\Exception $e) {
            throw new \Exception('crm.contacts.edit_add_tag.error_during_add', 500, $e);
        }
    }
}
