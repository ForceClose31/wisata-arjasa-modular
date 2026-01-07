<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageType;
use App\Models\TourPackage;
use App\Models\TourPackagePricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminTourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::with('packageType', 'pricings')
            ->latest()
            ->paginate(10);

        return view('admin.tour-packages.index', compact('packages'));
    }

    public function create()
    {
        $packageTypes = PackageType::where('is_active', true)->get();
        return view('admin.tour-packages.create', compact('packageTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_type_id' => 'required|exists:package_types,id',
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'duration_id' => 'required|string|max:255',
            'duration_en' => 'required|string|max:255',
            'highlights_id' => 'required|array|min:1',
            'highlights_id.*' => 'required|string|max:255',
            'highlights_en' => 'required|array|min:1',
            'highlights_en.*' => 'required|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'pricings' => 'required|array|min:1',
            'pricings.*.group_size' => 'required|string|max:255',
            'pricings.*.variant' => 'nullable|string|max:255',
            'pricings.*.price' => 'required|numeric|min:0',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tour-packages/images', 'public');
                $imagePaths[] = $path;
            }
        }

        $pdfPath = null;
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('tour-pdf', 'public');
        }

        $package = TourPackage::create([
            'package_type_id' => $validated['package_type_id'],
            'name' => [
                'id' => $validated['name_id'],
                'en' => $validated['name_en']
            ],
            'slug' => Str::slug($validated['name_id']),
            'description' => [
                'id' => $validated['description_id'],
                'en' => $validated['description_en']
            ],
            'duration' => [
                'id' => $validated['duration_id'],
                'en' => $validated['duration_en']
            ],
            'highlights' => [
                'id' => $validated['highlights_id'],
                'en' => $validated['highlights_en']
            ],
            'images' => $imagePaths,
            'pdf_url' => $pdfPath,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_available' => $validated['is_available'] ?? true,
        ]);

        foreach ($validated['pricings'] as $pricing) {
            $package->pricings()->create([
                'group_size' => $pricing['group_size'],
                'variant' => $pricing['variant'] ?? null,
                'price' => $pricing['price'],
            ]);
        }

        return redirect()->route('admin.tour-packages.index')
            ->with('success', 'Tour package successfully added');
    }

    public function edit(TourPackage $tourPackage)
    {
        $packageTypes = PackageType::where('is_active', true)->get();
        return view('admin.tour-packages.edit', compact('tourPackage', 'packageTypes'));
    }

    public function update(Request $request, TourPackage $tourPackage)
    {
        $validated = $request->validate([
            'package_type_id' => 'required|exists:package_types,id',
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'duration_id' => 'required|string|max:255',
            'duration_en' => 'required|string|max:255',
            'highlights_id' => 'required|array|min:1',
            'highlights_id.*' => 'required|string|max:255',
            'highlights_en' => 'required|array|min:1',
            'highlights_en.*' => 'required|string|max:255',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'pricings' => 'required|array|min:1',
            'pricings.*.id' => 'sometimes|exists:tour_package_pricings,id',
            'pricings.*.group_size' => 'required|string|max:255',
            'pricings.*.variant' => 'nullable|string|max:255',
            'pricings.*.price' => 'required|numeric|min:0',
            'deleted_images' => 'sometimes|array',
            'deleted_pricings' => 'sometimes|array',
        ]);

        $imagePaths = $tourPackage->images ?? [];

        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $imagePath) {
                if (($key = array_search($imagePath, $imagePaths)) !== false) {
                    Storage::disk('public')->delete($imagePath);
                    unset($imagePaths[$key]);
                }
            }
            $imagePaths = array_values($imagePaths);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tour-packages/images', 'public');
                $imagePaths[] = $path;
            }
        }

        $pdfPath = $tourPackage->pdf_path;
        if ($request->hasFile('pdf_file')) {
            if ($pdfPath) {
                Storage::disk('public')->delete($pdfPath);
            }
            $pdfPath = $request->file('pdf_file')->store('tour-pdf', 'public');
        }

        $tourPackage->update([
            'package_type_id' => $validated['package_type_id'],
            'name' => [
                'id' => $validated['name_id'],
                'en' => $validated['name_en']
            ],
            'slug' => Str::slug($validated['name_id']),
            'description' => [
                'id' => $validated['description_id'],
                'en' => $validated['description_en']
            ],
            'duration' => [
                'id' => $validated['duration_id'],
                'en' => $validated['duration_en']
            ],
            'highlights' => [
                'id' => $validated['highlights_id'],
                'en' => $validated['highlights_en']
            ],
            'images' => $imagePaths,
            'pdf_url' => $pdfPath,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_available' => $validated['is_available'] ?? true,
        ]);

        $existingPricingIds = $tourPackage->pricings()->pluck('id')->toArray();
        $updatedPricingIds = [];

        foreach ($validated['pricings'] as $pricingData) {
            if (isset($pricingData['id'])) {
                $pricing = $tourPackage->pricings()->find($pricingData['id']);
                if ($pricing) {
                    $pricing->update([
                        'group_size' => $pricingData['group_size'],
                        'variant' => $pricingData['variant'] ?? null,
                        'price' => $pricingData['price'],
                    ]);
                    $updatedPricingIds[] = $pricing->id;
                }
            } else {
                $newPricing = $tourPackage->pricings()->create([
                    'group_size' => $pricingData['group_size'],
                    'variant' => $pricingData['variant'] ?? null,
                    'price' => $pricingData['price'],
                ]);
                $updatedPricingIds[] = $newPricing->id;
            }
        }

        $pricingsToDelete = array_diff($existingPricingIds, $updatedPricingIds);
        if (!empty($pricingsToDelete)) {
            $tourPackage->pricings()->whereIn('id', $pricingsToDelete)->delete();
        }

        return redirect()->route('admin.tour-packages.index')
            ->with('success', 'Tour package successfully updated');
    }

    public function destroy(TourPackage $tourPackage)
    {
        foreach ($tourPackage->images as $image) {
            Storage::disk('public')->delete($image);
        }

        if ($tourPackage->pdf_url) {
            Storage::disk('public')->delete($tourPackage->pdf_url);
        }

        $tourPackage->delete();

        return redirect()->route('admin.tour-packages.index')
            ->with('success', 'Tour package successfully deleted');
    }
}
