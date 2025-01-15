<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\KebabPlaceSortByCriteria;

class KebabPlaceFilterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'sby' => ['string', Rule::in(array_column(KebabPlaceSortByCriteria::cases(), "value"))],
            'sdirection' => ['string', Rule::in(["asc", "desc"]),],
            'ffillings' => ['regex:/^\[(\d+,)*\d+]$/'],
            'fsauces' => ['regex:/^\[(\d+,)*\d+]$/'],
            'fkraft' => ['boolean'],
            'paginate' => ['integer'],
            'page' => ['integer'],
        ];
    }
}
