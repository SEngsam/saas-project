<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SubscriptionRepositoryInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected SubscriptionRepositoryInterface $subscriptionRepo;

    public function __construct(SubscriptionRepositoryInterface $subscriptionRepo)
    {
        $this->subscriptionRepo = $subscriptionRepo;
    }

    public function index()
    {
        return response()->json($this->subscriptionRepo->all());
    }

    public function show($id)
    {
        return response()->json($this->subscriptionRepo->find($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date',
            'status' => 'required|string|in:active,cancelled,expired',
            'payment_method' => 'nullable|string',
            'payment_status' => 'required|string|in:pending,paid,failed',
        ]);

        return response()->json($this->subscriptionRepo->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'plan_id' => 'sometimes|exists:plans,id',
            'starts_at' => 'sometimes|date',
            'ends_at' => 'nullable|date',
            'status' => 'sometimes|string|in:active,cancelled,expired',
            'payment_method' => 'nullable|string',
            'payment_status' => 'sometimes|string|in:pending,paid,failed',
        ]);

        return response()->json($this->subscriptionRepo->update($id, $data));
    }

    public function destroy($id)
    {
        $this->subscriptionRepo->delete($id);
        return response()->json(null, 204);
    }
}
