<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'regex:/^((?=.*[0-9])(?=.*[a-z])(?=.*([A-Z]|[!-\/:-@[-`{-~]))|(?=.*[A-Z])(?=.*[!-\/:-@[-`{-~])(?=.*([0-9]|[a-z])))[a-zA-Z0-9!-\/:-@[-`{-~]{8,}$/u',
            ],
            'password_confirmation' => 'required|same:password',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'There is an existing account using this email.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
