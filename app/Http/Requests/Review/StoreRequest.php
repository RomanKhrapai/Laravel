<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreRequest extends FormRequest
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
            'review' => 'nullable|string|max:5000|required_without:vote',
            'vote' => 'nullable|integer|gt:0|max:10|required_without_all:review,parent_id',
            'parent_id' => 'nullable|exists:reviews,id',

            'company_id' => 'nullable|exists:companies,id',

            'evaluated_company_id' => 'nullable|exists:companies,id|required_without:evaluated_user_id',
            'evaluated_user_id' => 'nullable|exists:users,id|required_without:evaluated_company_id',


        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
