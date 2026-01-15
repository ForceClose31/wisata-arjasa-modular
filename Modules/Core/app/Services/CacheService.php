<?php

namespace Modules\Core\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    protected int $defaultDuration = 3600;

    /**
     * Get cached data or execute callback
     */
    public function remember(string $key, callable $callback, ?int $duration = null): mixed
    {
        $duration = $duration ?? $this->defaultDuration;
        return Cache::remember($key, $duration, $callback);
    }

    /**
     * Get cached data with tags
     */
    public function rememberWithTags(array $tags, string $key, callable $callback, ?int $duration = null): mixed
    {
        $duration = $duration ?? $this->defaultDuration;
        return Cache::tags($tags)->remember($key, $duration, $callback);
    }

    /**
     * Forget cache by key
     */
    public function forget(string $key): bool
    {
        return Cache::forget($key);
    }

    /**
     * Flush cache by tags
     */
    public function flushTags(array $tags): bool
    {
        return Cache::tags($tags)->flush();
    }

    /**
     * Put data in cache
     */
    public function put(string $key, mixed $value, ?int $duration = null): bool
    {
        $duration = $duration ?? $this->defaultDuration;
        return Cache::put($key, $value, $duration);
    }

    /**
     * Check if cache exists
     */
    public function has(string $key): bool
    {
        return Cache::has($key);
    }

    /**
     * Clear all cache
     */
    public function flush(): bool
    {
        return Cache::flush();
    }
}
