<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => [
                    'required',
                    'regex:/^((?=.*[0-9])(?=.*[a-z])(?=.*([A-Z]|[!-\/:-@[-`{-~]))|(?=.*[A-Z])(?=.*[!-\/:-@[-`{-~])(?=.*([0-9]|[a-z])))[a-zA-Z0-9!-\/:-@[-`{-~]{8,}$/u',
                ],
                'password_confirmation' => 'required|same:password',
            ];
        } elseif ($this->isMethod('patch')) {
            return [
                'name' => 'sometimes|required',
                'email' => 'sometimes|required|email|unique:users,email,' . auth()->id(),
                'password' => [
                    'nullable',
                    'regex:/^((?=.*[0-9])(?=.*[a-z])(?=.*([A-Z]|[!-\/:-@[-`{-~]))|(?=.*[A-Z])(?=.*[!-\/:-@[-`{-~])(?=.*([0-9]|[a-z])))[a-zA-Z0-9!-\/:-@[-`{-~]{8,}$/u',
                ],
                'password_confirmation' => 'nullable|required_with:password|same:password',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa użytkownika jest wymagana.',
            'email.required' => 'Adres email jest wymagany.',
            'email.email' => 'Podaj poprawny adres email.',
            'email.unique' => 'Ten email jest już zajęty.',
            'password.required' => 'Hasło jest wymagane.',
            'password.regex' => 'Hasło musi mieć przynajmniej 8 znaków i spełniać co najmniej 3 wymagania: 1 dużą literę,  1 małą literę, 1 cyfrę, 1 znak specjalny',
            'password_confirmation.same' => 'Hasła muszą być identyczne.',
        ];
    }
}
