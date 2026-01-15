<?php

namespace Modules\Gallery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('POST') ? 'required' : 'nullable';

        return [
            'title.id' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'location' => 'required|string',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image_path' => "$imageRule|image|mimes:jpeg,png,jpg,webp|max:2048",
        ];
    }
}
