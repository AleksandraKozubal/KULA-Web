<?php

namespace App\Http\Requests;

use App\Enums\KebabPlaceLocationType;
use App\Enums\KebabPlaceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KebabPlaceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'building_number' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'string', 'max:255'],
            'google_maps_url' => ['required', 'string', 'max:255'],
            'google_maps_rating' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'fillings' => ['required', 'array'],
            'fillings.*' => ['required', 'string', 'max:255'],
            'sauces' => ['required', 'array'],
            'sauces.*' => ['required', 'string', 'max:255'],
            'opening_hours' => ['required', 'array'],
            'opening_hours.*.day' => ['required', 'string', 'max:255'],
            'opening_hours.*.hours' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(array_column(KebabPlaceStatus::cases(), 'value'))],
            'is_craft' => ['required', 'boolean'],
            'is_chain_restaurant' => ['required', 'boolean'],
            'location_type' => ['required', Rule::in(array_column(KebabPlaceLocationType::cases(), 'value'))],
            'order_options' => ['required', 'array'],
            'order_options.*' => ['required', 'string', 'max:255'],
            'social_media' => ['required', 'array'],
            'social_media.*.name' => ['required', 'string', 'max:255'],
            'social_media.*.url' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}