<?php

namespace App\Repositories;

use App\Models\Goal;

class GoalRepository
{
    // Lấy tất cả mục tiêu
    public function all()
    {
        return Goal::all();
    }

    // Lấy mục tiêu theo ID
    public function find($id)
    {
        return Goal::find($id);
    }

    // Tạo mới mục tiêu
    public function create(array $data)
    {
        return Goal::create($data);
    }

    // Cập nhật mục tiêu
    public function update($id, array $data)
    {
        $goal = Goal::find($id);
        if ($goal) {
            $goal->update($data);
            return $goal;
        }

        return null;
    }

    // Xóa mục tiêu
    public function delete($id)
    {
        $goal = Goal::find($id);
        if ($goal) {
            $goal->delete();
            return true;
        }

        return false;
    }
}
