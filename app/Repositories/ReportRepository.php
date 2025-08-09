<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function getSalesData($startDate, $endDate)
    {
        return DB::table('sales')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function getUserActivityData($startDate, $endDate)
    {
        return DB::table('user_activities')
            ->selectRaw('DATE_FORMAT(activity_date, "%Y-%m-%d") as day, COUNT(*) as total')
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->groupBy('day')
            ->orderBy('day')
            ->get();
    }
}
