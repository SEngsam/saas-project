<?php

namespace App\Repositories\Interfaces;

interface InvoiceRepositoryInterface
{
    public function all();
    public function findByUser($userId);
    public function create(array $data);
    public function markAsPaid($id);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
}
