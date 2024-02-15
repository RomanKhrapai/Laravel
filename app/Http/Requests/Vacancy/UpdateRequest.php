<?php

namespace App\Http\Requests\Vacancy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'closed' => 'nullable|boolean',
            'max_salary' => 'nullable|integer|gt:salary',
            'salary' => 'sometimes|required|integer|gt:0',
            'description' => 'sometimes|required|string|max:5000',
            'nature_id' => 'sometimes|required|exists:natures,id',
            'type_id' => 'sometimes|required|exists:types,id',
            'company_id' => 'sometimes|required|exists:companies,id',
            "experience_months" => 'nullable|integer|min:0',

            'area.id' => 'sometimes|nullable|exists:areas,id',
            'area.name' => 'required_if:area.id,null|string|max:255',

            'profession.id' => 'sometimes|nullable|exists:professions,id',
            'profession.name' => 'required_if:profession.id,null|string|max:255',

            'skills' => 'sometimes|array',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.id' => 'nullable|exists:skills,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
