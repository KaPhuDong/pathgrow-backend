<?php

namespace App\Repositories;

use App\Models\InClassSubject;
use App\Models\WeeklyStudyPlan;

class InClassSubjectRepository
{
    public function getByWeeklyStudyPlanId($weeklyPlanId)
    {
        $weeklyPlan = WeeklyStudyPlan::with('inClassPlan.inClassSubjects')->findOrFail($weeklyPlanId);

        return $weeklyPlan->inClassPlan?->inClassSubjects ?? collect();
    }

    public function create(array $data): InClassSubject
    {
        return InClassSubject::create($data);
    }

    public function find(int $id): ?InClassSubject
    {
        return InClassSubject::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $subject = InClassSubject::find($id);
        return $subject ? $subject->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $subject = InClassSubject::find($id);
        return $subject ? $subject->delete() : false;
    }
}
