<?php
namespace App\Repositories\Eloquent;

use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    public function all() {
        return Invoice::with('user', 'subscription')->latest()->get();
    }

    public function findByUser($userId) {
        return Invoice::where('user_id', $userId)->latest()->get();
    }


    public function find($id)
    {
        return Invoice::with(['user', 'subscription'])->findOrFail($id);
    }
    public function create(array $data) {
        return Invoice::create($data);
    }

    public function markAsPaid($id) {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = 'paid';
        $invoice->save();
        return $invoice;
    }
        public function update($id, array $data)
    {
        $invoice = $this->find($id);
        $invoice->update($data);
        return $invoice;
    }

    public function delete($id)
    {
        $invoice = $this->find($id);
        return $invoice->delete();
    }
}
