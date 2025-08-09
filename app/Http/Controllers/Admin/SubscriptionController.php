<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Repositories\Eloquent\SubscriptionRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    protected $subscriptionRepo;

    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepo = $subscriptionRepo;
    }

    public function index()
    {
        $subscriptions = $this->subscriptionRepo->all();

        return Inertia::render('Admin/Subscriptions/Index', compact('subscriptions'));
    }
    public function create()
    {
        $plans = Plan::all();
        $users = User::all();

        return Inertia::render('Admin/Subscriptions/Create', [
            'plans' => $plans,
            'users' => $users,
        ]);
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'plan_id'     => 'required|exists:plans,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'is_active'   => 'nullable|boolean',
        ]);

        $this->subscriptionRepo->create($data);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully.');
    }
    public function edit($id)
    {
        $subscription = $this->subscriptionRepo->find($id);
        return Inertia::render('Admin/Subscriptions/Edit', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'is_active' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $this->subscriptionRepo->update($id, $data);
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy($id)
    {
        $this->subscriptionRepo->delete($id);
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
