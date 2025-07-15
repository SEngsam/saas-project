<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Repositories\PlanRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlanController extends Controller
{
    protected PlanRepository $repo;

    public function __construct(PlanRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $plans = Plan::latest()->paginate(10);

        return Inertia::render('Plans/Index', [
            'plans' => $plans
        ]);
    }

    public function form(?Plan $plan = null)
    {
        return Inertia::render('Plans/PlanForm', [
            'plan' => $plan
        ]);
    }

    public function save(Request $request, $planId = null)
    {

        $plan = $planId ? Plan::findOrFail($planId) : null;

        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration_days' => 'required|integer',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string',
            'assignee' => 'nullable|string',
        ]);



        if ($plan) {
            $this->repo->update($plan->id, $validated);
        } else {
            $this->repo->create($validated);
        }

        return redirect()->route('plans.index')->with('success', $plan ? 'تم تعديل الخطة' : 'تم إنشاء الخطة');
    }

    public function destroy($id)
{
    $plan = Plan::findOrFail($id);
    $plan->delete();

    return redirect()->route('plans.index')->with('success', 'تم حذف الخطة بنجاح');
}
}
