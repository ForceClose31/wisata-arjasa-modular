<?php

namespace Modules\Destination\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Destination\app\Http\Requests\DestinationRequest;
use Modules\Destination\app\Models\Destination;
use Modules\Destination\app\Models\DestinationCategory;
use Modules\Core\app\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminDestinationController extends Controller
{
    public function __construct(
        private ImageService $imageService
    ) {
    }

    public function index(): View
    {
        $destinations = Destination::with('category:id,name')
            ->latest()
            ->paginate(15);

        return view('destination::admin.destinations.index', compact('destinations'));
    }

    public function create(): View
    {
        $categories = DestinationCategory::select('id', 'name')->get();
        return view('destination::admin.destinations.create', compact('categories'));
    }

    public function store(DestinationRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->store(
                $request->file('image'),
                'destinations'
            );
        }

        Destination::create($data);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', __('Destination successfully created'));
    }

    public function edit(Destination $destination): View
    {
        $categories = DestinationCategory::select('id', 'name')->get();
        return view('destination::admin.destinations.edit', compact('destination', 'categories'));
    }

    public function update(DestinationRequest $request, Destination $destination): RedirectResponse
    {
        $data = $this->prepareData($request);

        if ($request->hasFile('image')) {
            $this->imageService->delete($destination->image);
            $data['image'] = $this->imageService->store(
                $request->file('image'),
                'destinations'
            );
        }

        $destination->update($data);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', __('Destination successfully updated'));
    }

    public function destroy(Destination $destination): RedirectResponse
    {
        $this->imageService->delete($destination->image);
        $destination->delete();

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', __('Destination successfully deleted'));
    }

    private function prepareData(DestinationRequest $request): array
    {
        return [
            'category_id' => $request->category_id,
            'admin_id' => auth()->id(),
            'title' => [
                'id' => $request->title_id,
                'en' => $request->title_en,
            ],
            'description' => [
                'id' => $request->description_id,
                'en' => $request->description_en,
            ],
            'location' => [
                'id' => $request->location_id,
                'en' => $request->location_en,
            ],
            'operational_hours' => [
                'id' => $request->operational_hours_id,
                'en' => $request->operational_hours_en,
            ],
            'type' => [
                'id' => $request->type_id,
                'en' => $request->type_en,
            ],
            'facilities' => [
                'id' => $request->facilities_id,
                'en' => $request->facilities_en,
            ],
        ];
    }
}
