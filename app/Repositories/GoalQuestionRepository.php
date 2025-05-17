<?php

namespace App\Repositories;

use App\Models\GoalQuestion;

class GoalQuestionRepository
{
    // Lấy tất cả câu hỏi
    public function all()
    {
        return GoalQuestion::all();
    }

    // Lấy câu hỏi theo ID
    public function find($id)
    {
        return GoalQuestion::find($id);
    }

    // Tạo mới câu hỏi
    public function create(array $data)
    {
        return GoalQuestion::create($data);
    }

    // Cập nhật câu hỏi
    public function update($id, array $data)
    {
        $goalQuestion = GoalQuestion::find($id);
        if ($goalQuestion) {
            $goalQuestion->update($data);
            return $goalQuestion;
        }

        return null;
    }

    // Xóa câu hỏi
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
