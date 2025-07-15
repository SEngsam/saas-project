<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('user', 'plan')->paginate(10);

        return Inertia::render('Subscriptions/Index', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function create()
    {
        $plans = Plan::all();
        $users = User::all();

        return Inertia::render('Subscriptions/SubscriptionForm', [
            'plans' => $plans,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'status' => 'required|in:active,cancelled,expired',
            'payment_method' => 'nullable|string',
            'payment_status' => 'required|in:pending,completed,failed',
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    // عرض نموذج تعديل اشتراك
    public function edit(Subscription $subscription)
    {
        $plans = Plan::all();
        $users = User::all();

        return Inertia::render('Subscriptions/SubscriptionForm', [
            'subscription' => $subscription,
            'plans' => $plans,
            'users' => $users,
        ]);
    }

    // تحديث بيانات الاشتراك
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'status' => 'required|in:active,cancelled,expired',
            'payment_method' => 'nullable|string',
            'payment_status' => 'required|in:pending,completed,failed',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    // حذف اشتراك
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }
}
