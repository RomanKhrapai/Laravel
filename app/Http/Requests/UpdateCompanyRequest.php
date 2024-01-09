<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'mail' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('companies')->ignore($this->company),
            ],
            'foto_url' => 'nullable|url',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
