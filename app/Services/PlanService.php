<?php
namespace App\Services;

use App\Repositories\Interfaces\PlanRepositoryInterface;

class PlanService
{
    protected $planRepo;

    public function __construct(PlanRepositoryInterface $planRepo)
    {
        $this->planRepo = $planRepo;
    }

    public function getAllPlans()
    {
        return $this->planRepo->all();
    }

    public function createPlan(array $data)
    {
        return $this->planRepo->create($data);
    }

    public function updatePlan($id, array $data)
    {
        return $this->planRepo->update($id, $data);
    }

    public function deletePlan($id)
    {
        return $this->planRepo->delete($id);
    }

    public function getPlanById($id)
    {
        return $this->planRepo->find($id);
    }
}
