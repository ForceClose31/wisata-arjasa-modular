<?php

use App\Http\Controllers\User\{
    ContactController,
    CottageController,
    HomeController,
    TransportController
};
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');

Route::middleware('locale')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::view('/about', 'user.about.about')->name('about.index');
    Route::view('/e-booklet', 'user.destinasi-wisata.e-booklet')
        ->name('tourist-destination.ebooklet');

    Route::controller(ContactController::class)->prefix('contact')->group(function () {
        Route::get('/', 'index')->name('contact.index');
        Route::post('/', 'send')->name('contact.send');
    });

    Route::get('/cottage', [CottageController::class, 'index'])->name('cottage.index');
    Route::get('/transport', [TransportController::class, 'index'])->name('transport.index');
});
