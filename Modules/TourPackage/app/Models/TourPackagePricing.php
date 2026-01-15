<?php

namespace Modules\TourPackage\Models;

use Modules\Core\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourPackagePricing extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'tour_package_id',
        'group_size',
        'price',
        'variant'
    ];

    protected $casts = [
        'price' => 'integer'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFullDescriptionAttribute(): string
    {
        $description = $this->group_size;

        if ($this->variant) {
            $description .= " ({$this->variant})";
        }

        return $description;
    }
}
