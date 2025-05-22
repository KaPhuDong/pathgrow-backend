<?php

namespace App\Repositories;

use App\Models\WeeklyGoal;

class WeeklyGoalRepository
{
    public function getAllByStudyPlanId($studyPlanId)
    {
        return WeeklyGoal::where('weekly_study_plan_id', $studyPlanId)->get();
    }

    public function create($data)
    {
        return WeeklyGoal::create($data);
    }

    public function update($id, $data)
    {
        $goal = WeeklyGoal::findOrFail($id);
        $goal->update($data);
        return $goal;
    }

    public function delete($id)
    {
        return WeeklyGoal::destroy($id);
    }
}
