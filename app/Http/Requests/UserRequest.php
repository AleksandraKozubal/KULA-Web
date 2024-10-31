<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
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
}
