<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\User;
use App\Models\Plan;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        $invoices = $this->invoiceService->list();

        return Inertia::render('Admin/Invoices/Index', [
            'invoices' => $invoices,
        ]);
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        $plans = Plan::select('id', 'name')->get();

        return Inertia::render('Admin/Invoices/Create', [
            'users' => $users,
            'plans' => $plans,
        ]);
    }

    public function store(InvoiceRequest $request)
    {
        $this->invoiceService->store($request->validated());

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function edit($id)
    {
        $invoice = $this->invoiceService->find($id);
        $users = User::select('id', 'name')->get();
        $plans = Plan::select('id', 'name')->get();

        return Inertia::render('Admin/Invoices/Edit', [
            'invoice' => $invoice,
            'users' => $users,
            'plans' => $plans,
        ]);
    }

    public function update(InvoiceRequest $request, $id)
    {
        $this->invoiceService->update($id, $request->validated());

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        $this->invoiceService->destroy($id);

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
