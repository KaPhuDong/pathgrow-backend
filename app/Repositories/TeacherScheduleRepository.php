<?php

namespace App\Repositories;

use App\Models\TeacherSchedule;

class TeacherScheduleRepository
{
    protected $model;

    public function __construct(TeacherSchedule $model)
    {
        $this->model = $model;
    }

    // Lấy danh sách toàn bộ lịch của giáo viên (hoặc filter theo teacher_id)
    public function getAll($teacherId = null)
    {
        $query = $this->model->query();

        if ($teacherId) {
            $query->where('teacher_id', $teacherId);
        }

        return $query->get();
    }

    // Lấy lịch theo id
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Tạo mới lịch
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // Cập nhật lịch
    public function update($id, array $data)
    {
        $schedule = $this->find($id);
        if ($schedule) {
            $schedule->update($data);
            return $schedule;
        }
        return null;
    }

    // Xóa lịch
    public function delete($id)
    {
        $schedule = $this->find($id);
        if ($schedule) {
            return $schedule->delete();
        }
        return false;
    }
}
