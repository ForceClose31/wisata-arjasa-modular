<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourPackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imagesRule = $this->isMethod('POST') ? 'required' : 'sometimes';

        return [
            'package_type_id' => 'required|exists:package_types,id',
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'duration_id' => 'required|string|max:255',
            'duration_en' => 'required|string|max:255',
            'highlights_id' => 'required|array|min:1',
            'highlights_id.*' => 'required|string|max:255',
            'highlights_en' => 'required|array|min:1',
            'highlights_en.*' => 'required|string|max:255',
            'images' => "$imagesRule|array|min:1",
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'pricings' => 'required|array|min:1',
            'pricings.*.id' => 'sometimes|exists:tour_package_pricings,id',
            'pricings.*.group_size' => 'required|string|max:255',
            'pricings.*.variant' => 'nullable|string|max:255',
            'pricings.*.price' => 'required|numeric|min:0',
            'deleted_images' => 'sometimes|array',
            'deleted_pricings' => 'sometimes|array',
        ];
    }
}
