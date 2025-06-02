<?php

namespace App\Repositories;

use App\Models\GoalQuestion;

class GoalQuestionRepository
{
    public function all()
    {
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

    // Lấy các câu hỏi chưa trả lời của học sinh (user)
    public function getUnansweredByStudent($userId, $semesterId, $subjectId)
    {
        return GoalQuestion::where('user_id', $userId)
            ->where('semester_id', $semesterId)
            ->where('subject_id', $subjectId)
            ->whereNull('answer')
            ->with(['user', 'semester', 'subject'])
            ->get();
    }

    // Lấy các câu hỏi chưa trả lời cho giáo viên (lọc theo teacher_id trong goal_questions)
    // Thêm filter semester_id, subject_id nếu có
    public function getUnreadQuestionsForTeacher($teacherId, $semesterId = null, $subjectId = null)
    {
        $query = GoalQuestion::whereNull('answer')
            ->where('teacher_id', $teacherId);

        if ($semesterId) {
            $query->where('semester_id', $semesterId);
        }

        if ($subjectId) {
            $query->where('subject_id', $subjectId);
        }

        return $query->with(['user', 'semester', 'subject', 'answeredBy'])->get();
    }
}
