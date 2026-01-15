<?php

namespace Modules\Gallery\Models;

use Modules\Core\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GalleryCategory extends Model
{
    use HasFactory, HasTranslations, Loggable;

    protected $fillable = ['name', 'slug'];

    public $translatable = ['name'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }

        return $attributes;
    }
}
