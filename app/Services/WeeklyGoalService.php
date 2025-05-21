<?php

namespace App\Services;

use App\Repositories\WeeklyGoalRepository;

class WeeklyGoalService
{
    protected $repo;

    public function __construct(WeeklyGoalRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getGoals($studyPlanId)
    {
        return $this->repo->getAllByStudyPlanId($studyPlanId);
    }

    public function createGoal($data)
    {
        return $this->repo->create($data);
    }

    public function updateGoal($id, $data)
    {
        return $this->repo->update($id, $data);
    }

    public function deleteGoal($id)
    {
        return $this->repo->delete($id);
    }
}
