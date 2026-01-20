<?php

namespace Modules\Destination\Models;

use Modules\Core\Traits\Loggable;
use Modules\Core\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'location',
        'operational_hours',
        'image',
        'facilities',
        'type',
        'views_count',
        'admin_id',
        'slug'
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'facilities' => 'array',
        'location' => 'array',
        'operational_hours' => 'array',
        'type' => 'array',
        'views_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(DestinationCategory::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        $translations = $this->{$field};
        return is_array($translations) ? ($translations[$locale] ?? null) : null;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($destination) {
            $title = $destination->title[config('app.fallback_locale')] ?? '';
            $destination->slug = Str::slug($title);
        });

        static::updating(function ($destination) {
            if ($destination->isDirty('title')) {
                $title = $destination->title[config('app.fallback_locale')];
                $destination->slug = Str::slug($title);
            }
        });
    }

    public function getMetaTitleForLocale($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->getTranslation('title', $locale);
    }

    public function getMetaDescriptionForLocale($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $description = $this->getTranslation('description', $locale);
        return Str::limit(strip_tags($description), 160);
    }
}
