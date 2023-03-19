<?php
namespace App\Http\Requests\Admin\Groups;

use App\Http\Requests\BaseRequest;

class SearchRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'order_column' => [ 'required', 'string' ],
            'order_order' => [ 'required', 'string' ],
            'page' => [ 'required', 'integer' ],
            'per_page' => [ 'required', 'integer' ]
        ];
    }
}
