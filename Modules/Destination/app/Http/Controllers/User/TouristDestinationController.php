<?php

namespace Modules\Destination\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\Destination\Models\DestinationCategory;
use Modules\Destination\Models\Destination;
use Modules\TourPackage\Models\TourPackage;
use Illuminate\Contracts\View\View;

class TouristDestinationController extends Controller
{
    public function index(): View
    {
        $categories = DestinationCategory::select('id', 'name')->get();

        $destinations = Destination::with('category:id,name')
            ->latest()
            ->get();

        $relatedPackages = TourPackage::where('is_available', true)
            ->where('is_featured', true)
            ->take(3)
            ->get();

        return view(
            'destination::user.destinasi-wisata.destinasi-wisata',
            compact('categories', 'destinations', 'relatedPackages')
        );
    }

    public function show(string $slug): View
    {
        $destination = Destination::with('category:id,name')
            ->where('slug', $slug)
            ->firstOrFail();

        $destination->increment('views_count');

        $nearbyDestinations = Destination::select('id', 'title', 'image', 'slug')
            ->where('id', '!=', $destination->id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $suggestedPackages = TourPackage::where('is_available', true)
            ->take(2)
            ->get();

        return view(
            'destination::user.destinasi-wisata.destinasi-wisata-detail',
            compact('destination', 'nearbyDestinations', 'suggestedPackages')
        );
    }
}
