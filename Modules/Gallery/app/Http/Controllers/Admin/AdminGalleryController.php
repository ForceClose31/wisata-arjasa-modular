<?php

namespace Modules\Gallery\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Gallery\Models\Gallery;
use Modules\Gallery\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('galleryCategory')->latest()->paginate(10);
        return view('gallery::admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        $categories = GalleryCategory::all();
        return view('gallery::admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title.id' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'location' => 'required|string',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('gallery', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['admin_id'] = auth()->id();

        Gallery::create([
            'title' => [
                'id' => $validated['title']['id'],
                'en' => $validated['title']['en'],
            ],
            'description' => [
                'id' => $validated['description']['id'],
                'en' => $validated['description']['en'],
            ],
            'location' => $validated['location'],
            'gallery_category_id' => $validated['gallery_category_id'],
            'image_path' => $validated['image_path'] ?? null,
            'admin_id' => $validated['admin_id'],
        ]);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil ditambahkan');
    }

    public function edit(Gallery $gallery)
    {
        $categories = GalleryCategory::all();
        return view('gallery::admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title.id' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'location' => 'required|string',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $imagePath = $request->file('image_path')->store('gallery', 'public');
            $validated['image_path'] = $imagePath;
        }

        $gallery->update([
            'title' => [
                'id' => $validated['title']['id'],
                'en' => $validated['title']['en'],
            ],
            'description' => [
                'id' => $validated['description']['id'],
                'en' => $validated['description']['en'],
            ],
            'location' => $validated['location'],
            'gallery_category_id' => $validated['gallery_category_id'],
            'image_path' => $validated['image_path'] ?? $gallery->image_path,
        ]);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Destinasi wisata berhasil diperbarui');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Destinasi wisata berhasil dihapus');
    }
}
