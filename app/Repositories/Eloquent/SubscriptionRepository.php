<?php

namespace App\Repositories\Eloquent;

use App\Models\Subscription;

class SubscriptionRepository
{
    public function all()
    {
        return Subscription::with(['user', 'plan'])->paginate(10);
    }

    public function find($id)
    {
        return Subscription::with(['user', 'plan'])->findOrFail($id);
    }



    public function update($id, array $data)
    {
        $subscription = $this->find($id);
        $subscription->update($data);
        return $subscription;
    }

    public function delete($id)
    {
        return Subscription::destroy($id);
    }
    public function getActiveByUser($userId)
    {
        return Subscription::with('plan')
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->first();
    }

    public function getHistoryByUser($userId)
    {
        return Subscription::with('plan')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function create(array $data)
    {
        return Subscription::create($data);
    }

    public function cancel($subscriptionId)
    {
        return Subscription::where('id', $subscriptionId)->update([
            'is_active' => false
        ]);
    }
}
