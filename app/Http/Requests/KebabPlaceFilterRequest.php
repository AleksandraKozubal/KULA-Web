<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\KebabPlaceSortByCriteria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KebabPlaceFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "sby" => ["string", Rule::in(array_column(KebabPlaceSortByCriteria::cases(), "value"))],
            "sdirection" => ["string", Rule::in(["asc", "desc"])],
            "ffillings" => ["regex:/^\[(\d+,)*\d+]$/"],
            "fsauces" => ["regex:/^\[(\d+,)*\d+]$/"],
            "fkraft" => ["boolean"],
            "paginate" => ["integer"],
            "page" => ["integer"],
        ];
    }
}
