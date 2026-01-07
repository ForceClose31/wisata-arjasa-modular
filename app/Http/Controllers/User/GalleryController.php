<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
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

        if ($request->ajax()) {
            return response()->json([
                'galleries' => $galleries,
                'html' => view(
                    'user.gallery.partials.gallery-grid',
                    compact('galleries')
                )->render()
            ]);
        }

        return view(
            'user.gallery.gallery',
            compact('galleries', 'categories', 'selectedCategory')
        );
    }
}
