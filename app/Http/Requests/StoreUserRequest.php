<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'image' => 'nullable|string|max:255',
            'telephone' => [
                'required',
                'string',
                'regex:/^\+?[0-9\s-]+$/',
            ],
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
