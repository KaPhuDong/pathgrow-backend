<?php

namespace App\Repositories;

use App\Models\Goal;

class GoalRepository
{
    public function all()
    {
        return Goal::all();
    }

    public function find($id)
    {
        return Goal::find($id);
    }

    public function create(array $data)
    {
        return Goal::create($data);
    }

    public function update($id, array $data)
    {
        $goal = Goal::findOrFail($id);
        $goal->update($data);
        return $goal;
    }

    public function delete($id)
    {
        return Goal::destroy($id);
    }

    public function findByUserSemesterSubject($userId, $semesterId, $subjectId)
    {
        return Goal::where('user_id', $userId)
            ->where('semester_id', $semesterId)
            ->where('subject_id', $subjectId)
            ->first();
    }
}
