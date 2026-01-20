<?php

namespace Modules\Gallery\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\Gallery\Models\Gallery;
use Modules\Gallery\Models\GalleryCategory;
use Modules\Destination\Models\Destination; 
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class GalleryController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $categories = GalleryCategory::select('id', 'name', 'slug')->get();
        $selectedCategory = $request->input('category');

        $galleries = Gallery::with('galleryCategory:id,name,slug')
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->whereHas(
                    'galleryCategory',
                    fn($q) => $q->where('slug', $selectedCategory)
                );
            })
            ->latest()
            ->get();

        $featuredDestinations = Destination::select('id', 'title', 'image', 'slug', 'location')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'galleries' => $galleries,
                'html' => view(
                    'gallery::user.gallery.partials.gallery-grid',
                    compact('galleries')
                )->render()
            ]);
        }

        return view(
            'gallery::user.gallery.gallery',
            compact('galleries', 'categories', 'selectedCategory', 'featuredDestinations')
        );
    }

    public function show(Gallery $gallery): View
    {
        $relatedDestinations = $gallery->getNearbyDestinations(4);

        return view(
            'gallery::user.gallery.show',
            compact('gallery', 'relatedDestinations')
        );
    }
}