<?php
namespace App\Http\Requests\Admin\ApiKeys;

use App\Http\Requests\BaseRequest;

class SearchRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'page' => [ 'required', 'integer' ],
            'per_page' => [ 'required', 'integer' ]
        ];
    }
}
