<?php

namespace Modules\Core\app\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function store(UploadedFile $file, string $directory, ?int $width = null): string
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        if ($width) {
            $image = $this->manager->read($file->getRealPath())
                ->scaleDown(width: $width)
                ->encodeByExtension($file->getClientOriginalExtension(), quality: 85);

            Storage::disk('public')->put($path, $image);
        } else {
            $file->storeAs($directory, $filename, 'public');
        }

        return $path;
    }

    public function storeMultiple(array $files, string $directory, ?int $width = null): array
    {
        return array_map(fn($f) => $this->store($f, $directory, $width), $files);
    }

    public function delete(?string $path): bool
    {
        return $path && Storage::disk('public')->exists($path)
            ? Storage::disk('public')->delete($path)
            : false;
    }

    public function deleteMultiple(array $paths): void
    {
        foreach ($paths as $path) {
            $this->delete($path);
        }
    }
}
