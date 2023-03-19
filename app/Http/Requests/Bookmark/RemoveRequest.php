<?php
namespace App\Http\Requests\Bookmark;

use App\Http\Requests\BaseRequest;

class RemoveRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'entity_type' => [ 'required', 'string' ],
            'entity_id' => [ 'required', 'integer' ]
        ];
    }
}
