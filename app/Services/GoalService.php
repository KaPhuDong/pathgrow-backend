<?php
namespace App\Services;

use App\Repositories\GoalRepositoryInterface;

class GoalService implements GoalServiceInterface
{
    protected $goalRepository;

    public function __construct(GoalRepositoryInterface $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    public function getAllGoals()
    {
        return $this->goalRepository->all();
    }

    public function getGoalById($id)
    {
        return $this->goalRepository->find($id);
    }

    public function createGoal(array $data)
    {
        return $this->goalRepository->create($data);
    }

    public function updateGoal($id, array $data)
    {
        return $this->goalRepository->update($id, $data);
    }

    public function deleteGoal($id)
    {
        return $this->goalRepository->delete($id);
    }
}
