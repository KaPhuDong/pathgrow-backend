<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Goal;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo dữ liệu cho bảng Semester
        $semester = Semester::create(['name' => 'Semester 1']);

        // Tạo dữ liệu cho bảng Subject
        $subject = Subject::create(['name' => 'IT English']);

        // Tạo dữ liệu cho bảng Goal
        Goal::create([
            'user_id' => 1, // Giả sử có user_id = 1
            'semester_id' => $semester->id, // Dùng ID của semester
            'subject_id' => $subject->id, // Dùng ID của subject
            'expect_course' => 'Learn more about ReactJS',
            'expect_teacher' => 'Attend all the classes',
            'expect_myself' => 'Complete all homework assignments',
        ]);
    }
}
