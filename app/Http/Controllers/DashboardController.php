<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{

    //

    public function index()
    {
        $user = Auth::user();

        // Invoices
        $invoices = Invoice::with('subscription.plan')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Total paid amount
        $totalPaid = $invoices->where('is_paid', true)->sum('amount');

        // Active subscriptions
        $activeCount = Subscription::where('user_id', $user->id)->where('is_active', true)->count();

        // Monthly payments
        $monthlyPayments = $invoices
            ->where('is_paid', true)
            ->groupBy(fn($inv) => \Carbon\Carbon::parse($inv->created_at)->format('Y-m'))
            ->map(fn($group) => $group->sum('amount'))
            ->toArray();

        // Monthly invoice counts
        $monthlyInvoiceCounts = $invoices
            ->groupBy(fn($inv) => \Carbon\Carbon::parse($inv->created_at)->format('Y-m'))
            ->map(fn($group) => $group->count())
            ->toArray();

        // Monthly subscriptions
        $monthlySubscriptions = Subscription::where('user_id', $user->id)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Plan distribution
        $plansSummary = Subscription::where('user_id', $user->id)
            ->with('plan')
            ->get()
            ->groupBy(fn($sub) => $sub->plan->name)
            ->map(fn($subs) => $subs->count())
            ->toArray();

        return Inertia::render('Dashboard', [
            'invoices' => $invoices,
            'totalPaid' => $totalPaid,
            'activeCount' => $activeCount,
            'monthlyPayments' => $monthlyPayments,
            'monthlyInvoiceCounts' => $monthlyInvoiceCounts,
            'monthlySubscriptions' => $monthlySubscriptions,
            'plansSummary' => $plansSummary,
        ]);
    }
}
