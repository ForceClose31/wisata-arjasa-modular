<?php

namespace Modules\Destination\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Destination\Database\Factories\DestinationFactory;

class Destination extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): DestinationFactory
    // {
    //     // return DestinationFactory::new();
    // }
}
