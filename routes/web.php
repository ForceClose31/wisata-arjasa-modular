<?php

use App\Http\Controllers\Admin\{
    AdminController,
    AdminDestinationController,
    AdminGalleryController,
    AdminTourPackageController
};
use App\Http\Controllers\User\{
    ArticleController,
    ContactController,
    CottageController,
    GalleryController,
    HomeController,
    TouristDestinationController,
    TransportController,
    TourPackageController
};
use App\Http\Controllers\Auth\AuthController;
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

    Route::controller(TourPackageController::class)->prefix('tour-package')->group(function () {
        Route::get('/', 'tourPackage')->name('tour-package.index');
        Route::get('/type/{packageType}', 'byType')->name('packages.by-type');
    });
    Route::get('/packages/{tourPackage}', [TourPackageController::class, 'show'])
        ->name('tour-packages.show');

    Route::controller(TouristDestinationController::class)
        ->prefix('tourist-destination')
        ->name('tourist-destination.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{slug}', 'show')->name('show');
        });

    Route::controller(ArticleController::class)->prefix('artikel')->group(function () {
        Route::get('/', 'index')->name('articles.all');
        Route::get('/{slug}', 'show')->name('articles.show');
        Route::get('/tag/{slug}', 'byTag')->name('articles.byTag');
    });

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

    Route::get('/cottage', [CottageController::class, 'index'])->name('cottage.index');

    Route::get('/transport', [TransportController::class, 'index'])->name('transport.index');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/activities/refresh', [AdminController::class, 'refreshActivities'])->name('activities.refresh');
        Route::get('/activities', [AdminController::class, 'activities'])->name('activities');
        Route::resource('destinations', AdminDestinationController::class)->except('show');
        Route::resource('tour-packages', AdminTourPackageController::class)->except('show');
        Route::resource('galleries', AdminGalleryController::class)->except('show');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
