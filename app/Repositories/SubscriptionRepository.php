<?php

namespace App\Repositories;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Subscription::with(['user', 'plan']);

        $user = Auth::user();

        if (!$user?->is_admin) {

            $query->where('user_id', $user->id);
        } else {
            //if admin
            if (!empty($filters['user'])) {
                $query->whereHas('user', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['user'] . '%');
                });
            }
        }

        // Plan Filter
        if (!empty($filters['plan'])) {
            $query->whereHas('plan', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['plan'] . '%');
            });
        }

        // Statud Filter
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->get();
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
