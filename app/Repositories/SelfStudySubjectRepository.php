<?php

namespace App\Repositories;

use App\Models\SelfStudySubject;
use App\Models\WeeklyStudyPlan;

class SelfStudySubjectRepository
{

    public function getByWeeklyStudyPlanId($weeklyPlanId)
    {
        $weeklyPlan = WeeklyStudyPlan::with('selfStudyPlan.selfStudySubjects')->findOrFail($weeklyPlanId);

        return $weeklyPlan->selfStudyPlan?->selfStudySubjects ?? collect();
    }

    public function create(array $data): SelfStudySubject
    {
        return SelfStudySubject::create($data);
    }

    public function find(int $id): ?SelfStudySubject
    {
        return SelfStudySubject::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $subject = SelfStudySubject::find($id);
        return $subject ? $subject->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $subject = SelfStudySubject::find($id);
        return $subject ? $subject->delete() : false;
    }
}
