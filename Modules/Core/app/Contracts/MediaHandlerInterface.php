<?php

namespace Modules\Core\Contracts;

use Illuminate\Http\UploadedFile;

interface MediaHandlerInterface
{
    /**
     * Store a single file
     */
    public function store(UploadedFile $file, string $directory, ?int $width = null): string;

    /**
     * Store multiple files
     */
    public function storeMultiple(array $files, string $directory, ?int $width = null): array;

    /**
     * Delete a file
     */
    public function delete(?string $path): bool;

    /**
     * Delete multiple files
     */
    public function deleteMultiple(array $paths): void;

    /**
     * Get file URL
     */
    public function getUrl(string $path): string;

    /**
     * Check if file exists
     */
    public function exists(string $path): bool;
}
