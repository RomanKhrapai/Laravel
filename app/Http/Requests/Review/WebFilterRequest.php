<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class WebFilterRequest extends FormRequest
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
            'id' => ['nullable', 'exists:reviews,id'],
            'parent_id' => ['nullable', 'exists:reviews,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'evaluated_user_id' => ['nullable', 'exists:users,id'],
            'evaluated_company_id' => ['nullable', 'exists:companies,id'],
            'vote' => ['nullable', 'integer', 'min:0', 'max:10'],
            'review' => ['nullable', 'string', 'max:2000'],

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
}
