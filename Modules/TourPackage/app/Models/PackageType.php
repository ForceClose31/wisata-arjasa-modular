<?php

namespace Modules\TourPackage\Models;

use Modules\Core\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class PackageType extends Model
{
    use HasFactory, HasTranslations, Loggable;

    public $translatable = ['name', 'description'];

    protected $fillable = ['name', 'slug', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function tourPackages(): HasMany
    {
        return $this->hasMany(TourPackage::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
