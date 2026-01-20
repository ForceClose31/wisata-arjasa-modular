<?php

use Illuminate\Support\Facades\Route;
use Modules\Gallery\Http\Controllers\Admin\AdminGalleryController;
use Modules\Gallery\Http\Controllers\User\GalleryController;

Route::middleware('locale')->group(function () {
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/{gallery}', [GalleryController::class, 'show'])->name('gallery.show'); 
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::resource('galleries', AdminGalleryController::class)->except('show');
    });