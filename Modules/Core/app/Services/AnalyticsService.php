<?php

namespace Modules\Core\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsService
{
    /**
     * Track view count
     */
    public function trackView(string $type, int $id): void
    {
        DB::table('analytics_views')->insert([
            'type' => $type,
            'item_id' => $id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now()
        ]);
    }

    /**
     * Get popular items
     */
    public function getPopularItems(string $type, int $limit = 10, ?int $days = null): array
    {
        $query = DB::table('analytics_views')
            ->select('item_id', DB::raw('COUNT(*) as view_count'))
            ->where('type', $type);

        if ($days) {
            $query->where('created_at', '>=', Carbon::now()->subDays($days));
        }

        return $query->groupBy('item_id')
            ->orderByDesc('view_count')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Get view statistics
     */
    public function getViewStats(string $type, int $itemId, int $days = 30): array
    {
        $stats = DB::table('analytics_views')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as views')
            )
            ->where('type', $type)
            ->where('item_id', $itemId)
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'total_views' => $stats->sum('views'),
            'daily_views' => $stats->toArray()
        ];
    }

    /**
     * Get unique visitors
     */
    public function getUniqueVisitors(string $type, int $itemId, int $days = 30): int
    {
        return DB::table('analytics_views')
            ->where('type', $type)
            ->where('item_id', $itemId)
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->distinct('ip_address')
            ->count('ip_address');
    }
}
