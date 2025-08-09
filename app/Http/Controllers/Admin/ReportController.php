<?php
namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Services\ReportService;
use Inertia\Inertia;

class ReportController extends Controller
{
    protected $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return Inertia::render('Reports/Index');
    }

    public function show(ReportRequest $request)
    {
        $data = $this->service->generateReport(
            $request->report_type,
            $request->start_date,
            $request->end_date
        );

        return Inertia::render('Reports/Show', [
            'reportData' => $data,
            'reportType' => $request->report_type,
        ]);
    }
}
