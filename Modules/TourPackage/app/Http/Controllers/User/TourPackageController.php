<?php

namespace Modules\TourPackage\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\TourPackage\Models\TourPackage;
use Modules\TourPackage\Models\PackageType;
use Modules\Gallery\Models\Gallery;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TourPackageController extends Controller
{
    public function tourPackage(): View
    {
        $featuredPackages = TourPackage::with([
            'packageType:id,name',
            'pricings' => fn($q) => $q->orderBy('price')
        ])
            ->where('is_available', true)
            ->where('is_featured', true)
            ->latest()
            ->paginate(6);
        
        $showcaseGalleries = Gallery::with('galleryCategory')
            ->latest()
            ->take(8)
            ->get();

        return view('tourpackage::user.tour-package.tour-package', compact('featuredPackages', 'showcaseGalleries'));
    }

    public function byType(string $packageType): View
    {
        if ($packageType === 'all') {
            $tourPackages = TourPackage::with([
                'packageType:id,name',
                'pricings' => fn($q) => $q->orderBy('price')
            ])
                ->where('is_available', true)
                ->latest()
                ->paginate(9);

            $showcaseGalleries = Gallery::latest()->take(8)->get();

            return view('tourpackage::user.tour-package.tour-package', [
                'featuredPackages' => $tourPackages,
                'title' => __('All Tour Packages'),
                'showcaseGalleries' => $showcaseGalleries
            ]);
        }

        $type = PackageType::where('slug', $packageType)
            ->where('is_active', true)
            ->firstOrFail();

        $tourPackages = TourPackage::with([
            'packageType:id,name',
            'pricings' => fn($q) => $q->orderBy('price')
        ])
            ->where('package_type_id', $type->id)
            ->where('is_available', true)
            ->latest()
            ->paginate(6);

        $showcaseGalleries = Gallery::latest()->take(8)->get();

        return view('tourpackage::user.tour-package.tour-package', [
            'featuredPackages' => $tourPackages,
            'title' => $type->name,
            'showcaseGalleries' => $showcaseGalleries
        ]);
    }

    public function show(TourPackage $tourPackage): BinaryFileResponse
    {
        abort_if(!$tourPackage->is_available, 404);
        abort_if(!$tourPackage->pdf_path, 404);

        return response()->download(
            storage_path('app/public/' . $tourPackage->pdf_path)
        );
    }
}
