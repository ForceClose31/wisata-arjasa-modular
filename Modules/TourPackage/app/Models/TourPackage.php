<?php

namespace Modules\TourPackage\Models;

use Modules\Core\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class TourPackage extends Model
{
    use HasFactory, HasTranslations, Loggable;

    public $translatable = ['name', 'description', 'duration', 'highlights'];

    protected $fillable = [
        'package_type_id',
        'name',
        'slug',
        'description',
        'duration',
        'highlights',
        'images',
        'pdf_path',
        'is_featured',
        'is_available'
    ];
    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_available' => 'boolean'
    ];

    public function packageType(): BelongsTo
    {
        return $this->belongsTo(PackageType::class);
    }

    public function pricings(): HasMany
    {
        return $this->hasMany(TourPackagePricing::class);
    }

    public function getBasePriceAttribute(): ?TourPackagePricing
    {
        return $this->pricings()->orderBy('price')->first();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getMetaTitleForLocale($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->getTranslation('name', $locale);
    }

    public function getMetaDescriptionForLocale($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $description = $this->getTranslation('description', $locale);
        return Str::limit(strip_tags($description), 160);
    }
}
