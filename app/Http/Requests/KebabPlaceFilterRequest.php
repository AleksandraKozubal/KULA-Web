<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\KebabPlaceOrderOptions;
use App\Enums\KebabPlaceSortByCriteria;
use App\Enums\KebabPlaceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KebabPlaceFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "sby" => ["string", Rule::enum(KebabPlaceSortByCriteria::class)],
            "sdirection" => ["string", Rule::in(["asc", "desc"])],
            "fopen" => [Rule::in(["open", "closed"])],
            "fstatus" => [Rule::enum(KebabPlaceStatus::class)],
            "flocation" => ["string", Rule::in(["buda", "lokal"])],
            "fordering" => ["string", Rule::enum(KebabPlaceOrderOptions::class)],
            "fchain" => ["boolean"],
            "ffillings" => ["regex:/^\[(\d+,)*\d+]$/"],
            "fsauces" => ["regex:/^\[(\d+,)*\d+]$/"],
            "fkraft" => ["boolean"],
            "paginate" => ["integer"],
            "page" => ["integer"],
        ];
    }
}
