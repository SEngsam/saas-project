<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $activeSubscription = $user->subscriptions()
            ->where('status', 'active')
            ->with('plan')
            ->first();

        return Inertia::render('User/Index', [
            'user' => Auth::user(),
            'activeSubscription' => $activeSubscription,
        ]);

        // return Inertia::render('User/Dashboard', [
        //     'user' => $user,
        //     'subscription' => $subscription,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
