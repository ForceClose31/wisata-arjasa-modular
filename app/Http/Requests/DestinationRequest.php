<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('POST') ? 'required' : 'nullable';

        return [
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'category_id' => 'required|exists:destination_categories,id',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'location_id' => 'required|string',
            'location_en' => 'required|string',
            'operational_hours_id' => 'required|string',
            'operational_hours_en' => 'required|string',
            'type_id' => 'required|string',
            'type_en' => 'required|string',
            'facilities_id' => 'required|array',
            'facilities_en' => 'required|array',
            'image' => "$imageRule|image|mimes:jpeg,png,jpg,webp|max:2048",
        ];
    }
}
