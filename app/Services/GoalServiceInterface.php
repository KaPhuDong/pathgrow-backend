<?php
namespace App\Services;

interface GoalServiceInterface
{
    public function getAllGoals();
    public function getGoalById($id);
    public function createGoal(array $data);
    public function updateGoal($id, array $data);
    public function deleteGoal($id);
}
