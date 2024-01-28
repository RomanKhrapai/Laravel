<?php

namespace App\Http\Requests\Candidate;

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
            'title' => 'required|string|max:255',
            'salary' => 'required|integer|gt:0',
            'description' => 'required|string|max:5000',
            'nature_id' => 'required|exists:natures,id',
            'type_id' => 'required|exists:types,id',

            'area.id' => 'nullable|exists:areas,id',
            'area.name' => 'required|string|max:255',

            'profession.id' => 'nullable|exists:professions,id',
            'profession.name' => 'required|string|max:255',

            'skills' => '',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.id' => 'nullable|exists:skills,id',
            'experience_months' => "nullable|integer|gt:0"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
