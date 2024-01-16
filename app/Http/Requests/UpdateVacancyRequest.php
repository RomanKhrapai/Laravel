<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyRequest extends FormRequest
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
            'max_salary' => 'nullable|integer|gt:salary',
            'salary' => 'required|integer|gt:0',
            'description' => 'required|string|max:5000',
            'area_id' => 'required|exists:areas,id',
            'nature_id' => 'required|exists:natures,id',
            'type_id' => 'required|exists:types,id',
            'company_id' => 'required|exists:companies,id',
            'profession_id' => 'required|exists:professions,id',
        ];
    }
}
