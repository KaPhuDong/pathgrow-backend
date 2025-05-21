<?php

namespace App\Repositories;

use App\Models\WeeklyStudyPlan;

class WeeklyStudyPlanRepository
{
    public function getByStudentId($studentId)
    {
        return WeeklyStudyPlan::where('student_id', $studentId)->get();
    }

    public function find($id)
    {
        return WeeklyStudyPlan::findOrFail($id);
    }

    public function create(array $data)
    {
        return WeeklyStudyPlan::create($data);
    }

    public function update($id, array $data)
    {
        $plan = $this->find($id);
        $plan->update($data);
        return $plan;
    }

    public function delete($id)
    {
        $plan = $this->find($id);
        return $plan->delete();
    }
}
