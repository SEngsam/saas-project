<?php

namespace App\Services;

use App\Models\Subscription;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;


class InvoiceService
{
    protected $invoiceRepo;

    public function __construct(InvoiceRepositoryInterface $invoiceRepo)
    {
        $this->invoiceRepo = $invoiceRepo;
    }

        public function list()
    {
        return $this->invoiceRepo->all();
    }

    public function store(array $data)
    {
        return $this->invoiceRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->invoiceRepo->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->invoiceRepo->delete($id);
    }

    public function generateForSubscription(Subscription $subscription)
    {

        return $this->invoiceRepo->create([
            'user_id' => $subscription->user_id,
            'subscription_id' => $subscription->id,
            'amount' => $subscription->plan->price,
            'due_date' => now()->addDays(7),
            'invoice_number' => strtoupper(uniqid('INV-')),
            'status' => 'paid',

        ]);
    }





    public function find($id)
    {
        return $this->invoiceRepo->find($id);
    }





}
