<?php

namespace App\Repositories;

use App\Models\InClassPlan;

class InClassPlanRepository
{
    public function getPlanByWeeklyStudyPlanId(int $weeklyStudyPlanId): ?array
    {
        $plan = InClassPlan::where('weekly_study_plan_id', $weeklyStudyPlanId)
            ->first();

        return $plan ? $plan->toArray() : null;
    }

    public function create(array $data): InClassPlan
    {
        return InClassPlan::create($data);
    }

    public function find(int $id): ?InClassPlan
    {
        return InClassPlan::with('subjects')->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $plan = InClassPlan::find($id);
        return $plan ? $plan->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $plan = InClassPlan::find($id);
        return $plan ? $plan->delete() : false;
    }
}
