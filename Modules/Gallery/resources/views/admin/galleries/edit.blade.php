@extends('layouts.admin')

@section('title', 'Edit Gallery Wisata')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Edit Gallery Wisata</h2>

        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Bahasa Indonesia --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-medium mb-4 text-gray-800">Informasi (Bahasa Indonesia)</h3>

                    <div class="mb-4">
                        <label for="title_id" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title[id]" id="title_id"
                            value="{{ old('title.id', $gallery->getTranslation('title', 'id')) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="description_id" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description[id]" id="description_id" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description.id', $gallery->getTranslation('description', 'id')) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="location" id="location"
                            value="{{ old('location', $gallery->location) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                {{-- English --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-medium mb-4 text-gray-800">Information (English)</h3>

                    <div class="mb-4">
                        <label for="title_en" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title[en]" id="title_en"
                            value="{{ old('title.en', $gallery->getTranslation('title', 'en')) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="description_en" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description[en]" id="description_en" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description.en', $gallery->getTranslation('description', 'en')) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="gallery_category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="gallery_category_id" id="gallery_category_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $gallery->gallery_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->getTranslation('name', app()->getLocale()) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image_path" class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                    <input type="file" name="image" id="image_path" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG (Max: 5MB)</p>

                    @if ($gallery->image_path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Current Image"
                                class="h-32 w-auto rounded-md">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.galleries.index') }}"
                    class="mr-4 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Perbarui Gallery
                </button>
            </div>
        </form>
    </div>
@endsection
