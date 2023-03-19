<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

use function array_merge;
use function get_called_class;

class BaseRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = array_merge([ 'namespace' => get_called_class() ], $validator->errors()->all());

        Log::warning($errors);

        throw new \Exception('Failed request', 422);
    }
}
