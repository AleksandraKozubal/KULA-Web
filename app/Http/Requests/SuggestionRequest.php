<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuggestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "kebabPlace" => ["required", "integer", "exists:kebab_places,id"],
        ];
    }
}
