<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                Rule::unique('users')->ignore($this->user),
            ],
            'foto_url' => 'nullable|url',
            'telephone' => [
                'required',
                'string',
                'regex:/^\+?\d{1,3}\s\(\d{1,4}\)\s\d{1,6}-\d{1,8}$/',
            ],
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
