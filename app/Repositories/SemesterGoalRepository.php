<?php

namespace App\Repositories;

use App\Models\SemesterGoal;

class SemesterGoalRepository
{
    public function all()
    {
        return SemesterGoal::all();
    }

    public function find($id)
    {
        return SemesterGoal::find($id);
    }

    public function create(array $data)
    {
        return SemesterGoal::create($data);
    }

    public function update($id, array $data)
    {
        $goal = SemesterGoal::findOrFail($id);
        $goal->update($data);
        return $goal;
    }

    public function delete($id)
    {
        return SemesterGoal::destroy($id);
    }

    public function findByUserSemesterSubject($userId, $semesterId, $subjectId)
    {
        return SemesterGoal::where('user_id', $userId)
            ->where('semester_id', $semesterId)
            ->where('subject_id', $subjectId)
            ->first();
    }
}
