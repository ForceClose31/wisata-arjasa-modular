<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\Destination\Models\Destination;
use Modules\Destination\Models\DestinationCategory;
use Modules\Gallery\Models\GalleryCategory;
use Modules\TourPackage\Models\TourPackage;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $cultureTourismCategory = DestinationCategory::where('name->en', 'Culture Tourism')
            ->orWhere('name->id', 'Wisata Budaya')
            ->first();

        $situsBudayaCount = $cultureTourismCategory
            ? $cultureTourismCategory->destinations()->count()
            : 0;

        $activityCategory = GalleryCategory::where('name->en', 'Activity')
            ->orWhere('name->id', 'Aktivitas')
            ->first();

        $acaraLokalCount = $activityCategory
            ? $activityCategory->galleries()->count()
            : 0;

        $paketWisataCount = TourPackage::where('is_available', true)->count();

        $dayaTarikKategori = [
            ['en' => 'Culture Tourism', 'id' => 'Wisata Budaya'],
            ['en' => 'Special Interest Tourism', 'id' => 'Wisata Minat Khusus'],
            ['en' => 'Education Tourism', 'id' => 'Wisata Edukasi'],
            ['en' => 'Mass Tourism', 'id' => 'Wisata Buatan'],
        ];

        $dayaTarikAlamCount = Destination::whereIn('category_id', function ($query) use ($dayaTarikKategori) {
            $query->select('id')
                ->from('destination_categories')
                ->where(function ($q) use ($dayaTarikKategori) {
                    foreach ($dayaTarikKategori as $kat) {
                        $q->orWhere('name->en', $kat['en'])
                            ->orWhere('name->id', $kat['id']);
                    }
                });
        })->count();

        return view('user.index', compact(
            'situsBudayaCount',
            'acaraLokalCount',
            'paketWisataCount',
            'dayaTarikAlamCount'
        ));
    }
}
