<?php

namespace App\Services;

use App\Repositories\SelfStudyPlanRepository;

class SelfStudyPlanService
{
    protected $planRepository;

    public function __construct(SelfStudyPlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function getPlanByWeeklyStudyPlanId(int $weeklyStudyPlanId)
    {
        return $this->planRepository->getPlanByWeeklyStudyPlanId($weeklyStudyPlanId);
    }

    public function createPlan(array $data)
    {
        return $this->planRepository->create($data);
    }

    public function getPlan(int $id)
    {
        return $this->planRepository->find($id);
    }

    public function updatePlan(int $id, array $data)
    {
        return $this->planRepository->update($id, $data);
    }

    public function deletePlan(int $id)
    {
        return $this->planRepository->delete($id);
    }
}
