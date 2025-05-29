<?php

namespace App\Repositories;

use App\Models\GoalQuestion;

class GoalQuestionRepository
{
    public function all()
    {
        // Load luôn user, semester, subject, người trả lời (answeredBy)
        return GoalQuestion::with(['user', 'semester', 'subject', 'answeredBy'])->get();
    }

    public function find($id)
    {
        return GoalQuestion::with(['user', 'semester', 'subject', 'answeredBy'])->find($id);
    }

    public function create(array $data)
    {
        return GoalQuestion::create($data);
    }

    public function update($id, array $data)
    {
        $goalQuestion = GoalQuestion::find($id);
        if ($goalQuestion) {
            $goalQuestion->update($data);
            return $goalQuestion;
        }
        return null;
    }

    public function delete($id)
    {
        $goalQuestion = GoalQuestion::find($id);
        if ($goalQuestion) {
            $goalQuestion->delete();
            return true;
        }
        return false;
    }
}
