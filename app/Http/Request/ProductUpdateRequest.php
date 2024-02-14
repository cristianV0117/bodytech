<?php

namespace App\Http\Request;

use App\Http\Exceptions\ProductRequestException;
use App\Http\Helpers\RequestHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

final class ProductUpdateRequest extends FormRequest
{
    use RequestHelper;

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:45',
            'price' => 'nullable|integer',
            'user_last_update' => 'nullable|integer'
        ];
    }

    /**
     * @throws ProductRequestException
     */
    public function failedValidation(Validator $validator): void
    {
        throw new ProductRequestException($this->formatErrorsRequest($validator->errors()->all()), 400);
    }

}
