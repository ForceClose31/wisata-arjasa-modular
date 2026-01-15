<?php

namespace Modules\Core\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\app\Models\AdminActivity;
use Modules\Destination\app\Models\Destination;
use Modules\Gallery\app\Models\Gallery;
use Modules\TourPackage\app\Models\TourPackage;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $tourPackageCount = TourPackage::count();
        $destinationCount = Destination::count();
        $galleryCount = Gallery::count();

        $popularDestinations = Destination::with('category')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $recentActivities = AdminActivity::with('admin')
            ->latest()
            ->take(10)
            ->get();

        $weeklyStats = $this->getWeeklyStats();
        $monthlyViews = $this->getMonthlyViews();
        $totalViews = Destination::sum('views_count');

        return view('core::admin.dashboard', compact(
            'tourPackageCount',
            'destinationCount',
            'galleryCount',
            'popularDestinations',
            'recentActivities',
            'weeklyStats',
            'monthlyViews',
            'totalViews'
        ));
    }

    public function refreshActivities()
    {
        $recentActivities = AdminActivity::with('admin')
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'html' => view('core::admin.partials.activities', compact('recentActivities'))->render()
        ]);
    }

    public function activities()
    {
        $activities = AdminActivity::with('admin')
            ->latest()
            ->paginate(20);

        $stats = [
            'created' => AdminActivity::where('action', 'created')->count(),
            'updated' => AdminActivity::where('action', 'updated')->count(),
            'deleted' => AdminActivity::where('action', 'deleted')->count(),
            'total' => AdminActivity::count(),
        ];

        return view('core::admin.activities.index', compact('activities', 'stats'));
    }

    private function getWeeklyStats()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $tourPackages = TourPackage::whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })
            ->map(function ($day) {
                return $day->count();
            });

        $destinations = Destination::whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })
            ->map(function ($day) {
                return $day->count();
            });

        return [
            'tour_packages' => $tourPackages,
            'destinations' => $destinations
        ];
    }

    private function getMonthlyViews()
    {
        return Destination::selectRaw('MONTH(created_at) as month, SUM(views_count) as total_views')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get()
            ->pluck('total_views', 'month');
    }
}
