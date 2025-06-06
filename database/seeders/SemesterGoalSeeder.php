<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SemesterGoal;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;

class SemesterGoalSeeder extends Seeder
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
        $subject = Subject::create(['name' => 'IT English 2']);

        // Tạo dữ liệu cho bảng SemesterGoal
        SemesterGoal::create([
            'user_id' => 4, 
            'semester_id' => $semester->id, 
            'subject_id' => $subject->id,
            'expect_course' => 'Learn more about ReactJS',
            'expect_teacher' => 'Attend all the classes',
            'expect_myself' => 'Complete all homework assignments',
        ]);
    }
}
