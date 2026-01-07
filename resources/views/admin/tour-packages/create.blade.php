@extends('layouts.admin')

@section('title', 'Tambah Paket Wisata')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Tambah Paket Wisata</h2>

        <form action="{{ route('admin.tour-packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-medium mb-4 text-gray-800">Information (Bahasa Indonesia)</h3>

                    <div class="mb-4">
                        <label for="package_type_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Paket</label>
                        <select name="package_type_id" id="package_type_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Jenis Paket</option>
                            @foreach ($packageTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="name_id" class="block text-sm font-medium text-gray-700 mb-1">Nama Paket</label>
                        <input type="text" name="name_id" id="name_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="description_id" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description_id" id="description_id" rows="5" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="duration_id" class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                        <input type="text" name="duration_id" id="duration_id" placeholder="Contoh: 3 Hari 2 Malam"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Highlight (Fitur Unggulan)</label>
                        <div id="highlights-container-id">
                            <div class="flex mb-2">
                                <input type="text" name="highlights_id[]" required
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="button" onclick="addHighlightField('id')"
                                    class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-medium mb-4 text-gray-800">Information (English)</h3>

                    <div class="mb-4">
                        <label for="name_en" class="block text-sm font-medium text-gray-700 mb-1">Package Name</label>
                        <input type="text" name="name_en" id="name_en" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="description_en" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description_en" id="description_en" rows="5" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="duration_en" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <input type="text" name="duration_en" id="duration_en" placeholder="Example: 3 Days 2 Nights"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Highlights</label>
                        <div id="highlights-container-en">
                            <div class="flex mb-2">
                                <input type="text" name="highlights_en[]" required
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="button" onclick="addHighlightField('en')"
                                    class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Package Images</label>
                    <input type="file" name="images[]" id="images" multiple required accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, max 2MB</p>
                    <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
                </div>

                <div class="mb-4">
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-1">PDF File (Optional)</label>
                    <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Format: PDF, max 5MB</p>
                </div>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                    class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="is_featured" class="text-sm text-gray-700">Show as featured package</label>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_available" id="is_available" value="1" checked
                    class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="is_available" class="text-sm text-gray-700">Package available</label>
            </div>

            <div class="mt-6 border-t pt-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Pricing</h3>
                <div id="pricings-container" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end pricing-row">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Group Size</label>
                            <input type="text" name="pricings[0][group_size]" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Example: 1-5 People">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Variant</label>
                            <input type="text" name="pricings[0][variant]"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Example: Weekday">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                            <input type="number" name="pricings[0][price]" min="0" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <button type="button"
                                class="remove-pricing w-full px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-pricing"
                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    <i class="fas fa-plus"></i> Add Pricing
                </button>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.tour-packages.index') }}"
                    class="mr-4 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Package
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let pricingIndex = 1;

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

        document.getElementById('add-pricing').addEventListener('click', function() {
            const container = document.getElementById('pricings-container');
            const div = document.createElement('div');
            div.className = 'grid grid-cols-1 md:grid-cols-4 gap-4 items-end pricing-row';
            div.innerHTML = `
            <div>
                <input type="text" name="pricings[${pricingIndex}][group_size]" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Example: 1-5 People">
            </div>
            <div>
                <input type="text" name="pricings[${pricingIndex}][variant]"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Example: Weekend">
            </div>
            <div>
                <input type="number" name="pricings[${pricingIndex}][price]" min="0" required
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
            pricingIndex++;
        });

        document.getElementById('images').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';

            Array.from(e.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.className = 'h-24 w-auto rounded-md border';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
