<?php

namespace Modules\Gallery\Models;

use Modules\Core\Traits\Loggable;
use Modules\Core\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Modules\Destination\Models\Destination;

class Gallery extends Model
{
    use HasFactory, HasTranslations, Loggable;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'location',
        'gallery_category_id',
        'admin_id'
    ];

    public $translatable = ['title', 'description'];

    public function galleryCategory(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function getRelatedDestinationAttribute()
    {
        if (!$this->location) {
            return null;
        }

        return Destination::where('location->id', 'like', "%{$this->location}%")
            ->orWhere('location->en', 'like', "%{$this->location}%")
            ->first();
    }

    public function getNearbyDestinations($limit = 3)
    {
        return Destination::where('location->id', 'like', "%{$this->location}%")
            ->orWhere('location->en', 'like', "%{$this->location}%")
            ->limit($limit)
            ->get();
    }
}
