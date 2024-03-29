<?php

namespace App\Http\Requests\Review;

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
            'user_id' => ['nullable', 'exists:users,id', 'required_without:company_id'],
            'company_id' => ['nullable', 'exists:companies,id', 'required_without:user_id'],
            'page'  => ['nullable', 'integer', 'gt:0', 'max:100'],
            'per_page'  => ['nullable', 'integer', 'gt:1', 'max:100'],
            'sort_by' =>  [
                'nullable',
                'string',
                Rule::in([
                    'id',
                    'parent_id',
                    'user_id',
                    'company_id',
                    'evaluated_user_id',
                    'evaluated_company_id',
                    'vote',
                    'review',
                    'updated_at',
                    'created_at',
                    'deleted_at',
                ]),
            ],
            'sort_order' =>  [
                'nullable',
                'string',
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
