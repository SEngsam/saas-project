<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BillingHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $payments = $user->payments()
            ->latest()
            ->get(['id', 'amount', 'payment_method', 'created_at']);

        return Inertia::render('User/BillingHistory', [
            'payments' => $payments
        ]);
    }
}
