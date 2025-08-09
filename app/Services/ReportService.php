<?php

namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService
{
    protected $repo;

    public function __construct(ReportRepository $repo)
    {
        $this->repo = $repo;
    }

    public function generateReport($type, $startDate, $endDate)
    {
        switch ($type) {
            case 'sales':
                return $this->repo->getSalesData($startDate, $endDate);
            case 'users':
                return $this->repo->getUserActivityData($startDate, $endDate);
            default:
                throw new \InvalidArgumentException('Invalid report type');
        }
    }
}
