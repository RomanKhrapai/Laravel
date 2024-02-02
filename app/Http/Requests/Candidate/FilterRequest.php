<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

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
            'title' => 'nullable|string|max:50',
            'area_id' => 'nullable|exists:areas,id',
            'profession_id' => 'nullable|exists:professions,id',
            'page'  => 'nullable|integer|gt:0|max:100',
            'per_page'  => 'nullable|integer|gt:1|max:100',
        ];
    }
    // 'title' => 'required|string|max:255',
    // 'max_salary' => 'nullable|integer|gt:salary',
    // 'salary' => 'required|integer|gt:0',
    // 'description' => 'required|string|max:5000',
    // 'area_id' => 'required|exists:areas,id',
    // 'nature_id' => 'required|exists:natures,id',
    // 'type_id' => 'required|exists:types,id',
    // 'company_id' => 'required|exists:companies,id',
    // 'profession_id' => 'required|exists:professions,id',

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
