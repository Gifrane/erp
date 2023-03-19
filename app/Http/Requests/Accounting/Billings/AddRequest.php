<?php
namespace App\Http\Requests\Accounting\Billings;

use App\Http\Requests\BaseRequest;

use Illuminate\Validation\Rule;

class AddRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => [ 'required', 'string' ],
            'direction' => [ 'required', Rule::in([ 'expense', 'income' ]) ],
            'step' => [ 'required', Rule::in([ 'settled', 'waiting' ]) ],
            'amount_ht' => [ 'required', 'numeric' ],
            'amount_ttc' => [ 'required', 'numeric' ],
            'emitted_at' => [ 'sometimes', 'nullable', 'string' ],
            'completed_at' => [ 'sometimes', 'nullable', 'string' ],
            'receiver' => [ 'required' ],
            'emitter' => [ 'required' ]
        ];
    }
}
