<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PlanService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlanController extends Controller
{
    public function __construct(public PlanService $planService) {}

    public function index()
    {
        $plans = $this->planService->getAllPlans();
        return Inertia::render('Admin/Plans/Index', compact('plans'));
    }

    public function create()
    {
        return Inertia::render('Admin/Plans/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->planService->createPlan($data);
        return to_route('admin.plans.index')->with('success', 'Plan created.');
    }

    public function edit($id)
    {
        $plan = $this->planService->getPlanById($id);
        return Inertia::render('Admin/Plans/Edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->planService->updatePlan($id, $data);
        return to_route('admin.plans.index')->with('success', 'Plan updated.');
    }

    public function destroy($id)
    {
        $this->planService->deletePlan($id);
        return back()->with('success', 'Plan deleted.');
    }
}
