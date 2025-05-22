<?php

namespace App\Repositories;

use App\Models\SelfStudyPlan;

class SelfStudyPlanRepository
{

    public function getPlanByWeeklyStudyPlanId(int $weeklyStudyPlanId): ?array
    {
        $plan = SelfStudyPlan::where('weekly_study_plan_id', $weeklyStudyPlanId)
            ->first();

        return $plan ? $plan->toArray() : null;
    }

    public function create(array $data): SelfStudyPlan
    {
        return SelfStudyPlan::create($data);
    }

    public function find(int $id): ?SelfStudyPlan
    {
        return SelfStudyPlan::with('subjects')->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $plan = SelfStudyPlan::find($id);
        return $plan ? $plan->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $plan = SelfStudyPlan::find($id);
        return $plan ? $plan->delete() : false;
    }
}
