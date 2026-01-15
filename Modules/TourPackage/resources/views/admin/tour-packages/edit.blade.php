@extends('layouts.admin')

@section('title', 'Edit Paket Wisata')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Edit Paket Wisata</h2>

    <form action="{{ route('admin.tour-packages.update', $tourPackage) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-medium mb-4 text-gray-800">Informasi (Bahasa Indonesia)</h3>

                <div class="mb-4">
                    <label for="package_type_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Paket</label>
                    <select name="package_type_id" id="package_type_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Jenis Paket</option>
                        @foreach($packageTypes as $type)
                            <option value="{{ $type->id }}" {{ $tourPackage->package_type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="name_id" class="block text-sm font-medium text-gray-700 mb-1">Nama Paket</label>
                    <input type="text" name="name_id" id="name_id" value="{{ $tourPackage->getTranslation('name', 'id') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="description_id" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description_id" id="description_id" rows="5" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $tourPackage->getTranslation('description', 'id') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="duration_id" class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                    <input type="text" name="duration_id" id="duration_id" value="{{ $tourPackage->getTranslation('duration', 'id') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Highlight (Fitur Unggulan)</label>
                    <div id="highlights-container-id">
                        @foreach($tourPackage->getTranslation('highlights', 'id') as $index => $highlight)
                            <div class="flex mb-2">
                                <input type="text" name="highlights_id[]" value="{{ $highlight }}" required
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @if($index === 0)
                                    <button type="button" onclick="addHighlightField('id')"
                                            class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                @else
                                    <button type="button" onclick="this.parentElement.remove()"
                                            class="ml-2 px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-medium mb-4 text-gray-800">Information (English)</h3>

                <div class="mb-4">
                    <label for="name_en" class="block text-sm font-medium text-gray-700 mb-1">Package Name</label>
                    <input type="text" name="name_en" id="name_en" value="{{ $tourPackage->getTranslation('name', 'en') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="description_en" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description_en" id="description_en" rows="5" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $tourPackage->getTranslation('description', 'en') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="duration_en" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                    <input type="text" name="duration_en" id="duration_en" value="{{ $tourPackage->getTranslation('duration', 'en') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Highlights</label>
                    <div id="highlights-container-en">
                        @foreach($tourPackage->getTranslation('highlights', 'en') as $index => $highlight)
                            <div class="flex mb-2">
                                <input type="text" name="highlights_en[]" value="{{ $highlight }}" required
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @if($index === 0)
                                    <button type="button" onclick="addHighlightField('en')"
                                            class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                @else
                                    <button type="button" onclick="this.parentElement.remove()"
                                            class="ml-2 px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Package Images</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, max 5MB</p>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tourPackage->images as $index => $image)
                            <div class="relative">
                                <img src="{{ Storage::url($image) }}" alt="Package image" class="h-24 w-auto rounded-md border">
                                <button type="button" onclick="removeImage(this, '{{ $image }}')"
                                        class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                                <input type="hidden" name="deleted_images[]" id="deleted_image_{{ $index }}" value="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-1">PDF File (Optional)</label>
                <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Format: PDF, max 5MB</p>

                @if($tourPackage->pdf_path)
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current PDF</label>
                        <a href="{{ Storage::url($tourPackage->pdf_path) }}" target="_blank"
                           class="text-blue-600 hover:underline flex items-center">
                            <i class="fas fa-file-pdf mr-2"></i> View PDF
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $tourPackage->is_featured ? 'checked' : '' }}
                   class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <label for="is_featured" class="text-sm text-gray-700">Show as featured package</label>
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_available" id="is_available" value="1" {{ $tourPackage->is_available ? 'checked' : '' }}
                   class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <label for="is_available" class="text-sm text-gray-700">Package available</label>
        </div>

        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Pricing</h3>
            <div id="pricings-container" class="space-y-4">
                @foreach($tourPackage->pricings as $index => $pricing)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end pricing-row">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Group Size</label>
                            <input type="text" name="pricings[{{ $index }}][group_size]" value="{{ $pricing->group_size }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Example: 1-5 People">
                            <input type="hidden" name="pricings[{{ $index }}][id]" value="{{ $pricing->id }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Variant</label>
                            <input type="text" name="pricings[{{ $index }}][variant]" value="{{ $pricing->variant }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Example: Weekday">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                            <input type="number" name="pricings[{{ $index }}][price]" value="{{ $pricing->price }}" min="0" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <button type="button" onclick="this.closest('.pricing-row').remove()"
                                    class="w-full px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-pricing"
                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                <i class="fas fa-plus"></i> Add Pricing
            </button>
            <input type="hidden" id="pricing-index" value="{{ count($tourPackage->pricings) }}">
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('admin.tour-packages.index') }}"
               class="mr-4 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Update Package
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function addHighlightField(lang) {
        const container = document.getElementById(`highlights-container-${lang}`);
        const div = document.createElement('div');
        div.className = 'flex mb-2';
        div.innerHTML = `
            <input type="text" name="highlights_${lang}[]" required
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="button" onclick="this.parentElement.remove()"
                class="ml-2 px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(div);
    }

    function removeImage(button, imagePath) {
        const encodedPath = btoa(imagePath).replace(/[^a-zA-Z0-9]/g, '');
        const inputId = 'deleted_image_' + encodedPath;
        
        let hiddenInput = document.getElementById(inputId);
        if (!hiddenInput) {
            hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'deleted_images[]';
            hiddenInput.id = inputId;
            hiddenInput.value = imagePath;
            button.closest('form').appendChild(hiddenInput);
        } else {
            hiddenInput.value = imagePath;
        }
    
        button.parentElement.remove();
    }

    document.getElementById('add-pricing').addEventListener('click', function () {
        const container = document.getElementById('pricings-container');
        const index = parseInt(document.getElementById('pricing-index').value);
    
        const div = document.createElement('div');
        div.className = 'grid grid-cols-1 md:grid-cols-4 gap-4 items-end pricing-row';
        div.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Group Size</label>
                <input type="text" name="pricings[${index}][group_size]" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Example: 1-5 People">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Variant</label>
                <input type="text" name="pricings[${index}][variant]"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Example: Weekend">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                <input type="number" name="pricings[${index}][price]" min="0" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <button type="button" onclick="this.closest('.pricing-row').remove()"
                        class="w-full px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
        document.getElementById('pricing-index').value = index + 1;
    });
</script>
@endpush
