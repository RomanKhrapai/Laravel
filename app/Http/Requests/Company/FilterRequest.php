<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:50',
            'address' =>  'nullable|string|max:50',
            'page'  => 'nullable|integer|gt:0|max:100',
            'per_page'  => 'nullable|integer|gt:1|max:100',
            'sort' =>  [
                'nullable',
                'string',
                'max:50',
                Rule::in(['created_at', 'received_reviews_avg_vote']),
            ],
            'is_desc' =>  [
                'nullable',
                'string',
                'max:5',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
