<?php

namespace Modules\Core\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Boot the sluggable trait
     */
    protected static function bootSluggable(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateSlug();
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty($model->getSlugSource())) {
                $model->slug = $model->generateSlug();
            }
        });
    }

    /**
     * Generate unique slug
     */
    protected function generateSlug(): string
    {
        $source = $this->getSlugSourceValue();
        $slug = Str::slug($source);

        $count = static::where('slug', 'LIKE', "{$slug}%")
            ->where('id', '!=', $this->id ?? 0)
            ->count();

        return $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
    }

    /**
     * Get slug source column
     */
    protected function getSlugSource(): string
    {
        return property_exists($this, 'slugSource')
            ? $this->slugSource
            : 'title';
    }

    /**
     * Get slug source value
     */
    protected function getSlugSourceValue(): string
    {
        $source = $this->getSlugSource();
        $value = $this->{$source};

        // Handle translatable fields
        if (is_array($value)) {
            return $value[config('app.fallback_locale')] ??
                $value[app()->getLocale()] ??
                reset($value);
        }

        return $value;
    }

    /**
     * Get route key name
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
