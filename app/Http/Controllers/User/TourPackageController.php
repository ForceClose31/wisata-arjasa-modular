<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use App\Models\PackageType;
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

        return view('user.tour-package.tour-package', compact('featuredPackages'));
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

            return view('user.tour-package.tour-package', [
                'featuredPackages' => $tourPackages,
                'title' => __('All Tour Packages')
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

        return view('user.tour-package.tour-package', [
            'featuredPackages' => $tourPackages,
            'title' => $type->name
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
