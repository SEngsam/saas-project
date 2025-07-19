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
       $billingHistories = Auth::user()->subscriptions()->with('plan')->latest()->get();

    return inertia('User/BillingHistory', [
        'payments' => $billingHistories
    ]);
    }
}
