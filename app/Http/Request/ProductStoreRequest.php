<?php

namespace App\Http\Request;

use App\Http\Exceptions\ProductRequestException;
use App\Http\Helpers\RequestHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

final class ProductStoreRequest extends FormRequest
{
    use RequestHelper;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:45',
            'price' => 'required|integer',
            'status' => 'required|integer',
            'user_creator_id' => 'required|integer'
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
