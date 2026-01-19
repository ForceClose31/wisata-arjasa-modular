<?php

namespace Modules\TourPackage\Services;

use Illuminate\Support\Str;
use Modules\Core\Services\ImageService;
use Modules\TourPackage\Http\Requests\TourPackageRequest;
use Modules\TourPackage\Models\TourPackage;

class TourPackageService
{
    public function __construct(
        private ImageService $imageService
    ) {
    }

    public function create(TourPackageRequest $request): TourPackage
    {
        $data = $this->preparePackageData($request);

        if ($request->hasFile('images')) {
            $data['images'] = $this->imageService->storeMultiple(
                $request->file('images'),
                'tour-packages/images',
                1200
            );
        }

        if ($request->hasFile('pdf_file')) {
            $data['pdf_url'] = $request->file('pdf_file')
                ->store('tour-pdf', 'public');
        }

        $package = TourPackage::create($data);
        $this->syncPricings($package, $request->pricings);

        return $package;
    }

    public function update(TourPackageRequest $request, TourPackage $package): TourPackage
    {
        $data = $this->preparePackageData($request);
        $imagePaths = $package->images ?? [];

        // Handle deleted images
        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $imagePath) {
                if (($key = array_search($imagePath, $imagePaths)) !== false) {
                    $this->imageService->delete($imagePath);
                    unset($imagePaths[$key]);
                }
            }
            $imagePaths = array_values($imagePaths);
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $newImages = $this->imageService->storeMultiple(
                $request->file('images'),
                'tour-packages/images',
                1200
            );
            $imagePaths = array_merge($imagePaths, $newImages);
        }

        $data['images'] = $imagePaths;

        // Handle PDF
        if ($request->hasFile('pdf_file')) {
            $this->imageService->delete($package->pdf_url);
            $data['pdf_url'] = $request->file('pdf_file')
                ->store('tour-pdf', 'public');
        }

        $package->update($data);
        $this->syncPricings($package, $request->pricings);

        return $package;
    }

    public function delete(TourPackage $package): bool
    {
        $this->imageService->deleteMultiple($package->images ?? []);
        $this->imageService->delete($package->pdf_url);

        return $package->delete();
    }

    private function preparePackageData(TourPackageRequest $request): array
    {
        return [
            'package_type_id' => $request->package_type_id,
            'name' => [
                'id' => $request->name_id,
                'en' => $request->name_en
            ],
            'slug' => Str::slug($request->name_id),
            'description' => [
                'id' => $request->description_id,
                'en' => $request->description_en
            ],
            'duration' => [
                'id' => $request->duration_id,
                'en' => $request->duration_en
            ],
            'highlights' => [
                'id' => $request->highlights_id,
                'en' => $request->highlights_en
            ],
            'is_featured' => $request->boolean('is_featured'),
            'is_available' => $request->boolean('is_available', true),
        ];
    }

    private function syncPricings(TourPackage $package, array $pricings): void
    {
        $existingIds = $package->pricings()->pluck('id')->toArray();
        $updatedIds = [];

        foreach ($pricings as $pricingData) {
            if (isset($pricingData['id'])) {
                $pricing = $package->pricings()->find($pricingData['id']);
                if ($pricing) {
                    $pricing->update([
                        'group_size' => $pricingData['group_size'],
                        'variant' => $pricingData['variant'] ?? null,
                        'price' => $pricingData['price'],
                    ]);
                    $updatedIds[] = $pricing->id;
                }
            } else {
                $newPricing = $package->pricings()->create([
                    'group_size' => $pricingData['group_size'],
                    'variant' => $pricingData['variant'] ?? null,
                    'price' => $pricingData['price'],
                ]);
                $updatedIds[] = $newPricing->id;
            }
        }

        $toDelete = array_diff($existingIds, $updatedIds);
        if (!empty($toDelete)) {
            $package->pricings()->whereIn('id', $toDelete)->delete();
        }
    }
}

