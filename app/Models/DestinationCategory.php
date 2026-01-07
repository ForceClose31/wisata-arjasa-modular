<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class DestinationCategory extends Model
{
    use HasTranslations, Loggable;

    protected $fillable = ['name', 'slug'];

    public $translatable = ['name'];

    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class, 'category_id');
    }
}
