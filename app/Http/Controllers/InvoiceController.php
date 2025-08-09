<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Auth::user()->invoices()->latest()->get();

        return Inertia::render('Invoices/Index', [
            'invoices' => $invoices,
        ]);
    }
}
