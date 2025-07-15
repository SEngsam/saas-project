<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function all()
    {
        return Subscription::with(['user', 'plan'])->get();
    }

    public function find($id)
    {
        return Subscription::with(['user', 'plan'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Subscription::create($data);
    }

    public function update($id, array $data)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($data);
        return $subscription;
    }

    public function delete($id)
    {
        return Subscription::destroy($id);
    }
}
