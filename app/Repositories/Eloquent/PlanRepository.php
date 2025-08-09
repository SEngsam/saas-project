<?php
namespace App\Repositories\Eloquent;

use App\Models\Plan;
use App\Repositories\Interfaces\PlanRepositoryInterface;

class PlanRepository implements PlanRepositoryInterface
{
    public function all()
    {
        return Plan::all();
    }

    public function find($id)
    {
        return Plan::findOrFail($id);
    }

    public function create(array $data)
    {
        return Plan::create($data);
    }

    public function update($id, array $data)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($data);
        return $plan;
    }

    public function delete($id)
    {
        return Plan::destroy($id);
    }
}
