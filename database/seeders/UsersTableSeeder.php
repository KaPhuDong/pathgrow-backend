<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'class_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teacher One',
                'email' => 'teacher1@example.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'class_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teacher Two',
                'email' => 'teacher2@example.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'class_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student One',
                'email' => 'student1@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'class_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student Two',
                'email' => 'student2@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'class_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Danh sách tên học sinh từng lớp (bạn có thể thêm tên thật cho từng lớp)
        $students = [
            1 => [
                "Zoăn Thị Bằng", "Y Xa Bế", "Coor Chăng", "Phạm Đức Đạt", "Trần Công Đoàn",
                "Nguyễn Thị Kim Tuyên", "Hồ Thị Duyên Hà", "Ngô Thị Kim Hân", "Hồ Văn Hạnh",
                "Huỳnh Hữu Hậu",
                // Thêm học sinh mẫu để đủ 21
                "Student 11", "Student 12", "Student 13", "Student 14", "Student 15",
                "Student 16", "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            2 => [
                "Zo Râm Thị Phấn", "Hồ Tư Hãn", "Hồ Thị Kim", "Zo Râm Tuyền",
                // Thêm học sinh mẫu để đủ 21
                "Student 5", "Student 6", "Student 7", "Student 8", "Student 9", "Student 10",
                "Student 11", "Student 12", "Student 13", "Student 14", "Student 15", "Student 16",
                "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            3 => [
                "Un Hoàng Phương Anh", "Đinh Tuấn Vỹ", "Hồ Thị Huệ",
                // Thêm học sinh mẫu để đủ 21
                "Student 4", "Student 5", "Student 6", "Student 7", "Student 8", "Student 9",
                "Student 10", "Student 11", "Student 12", "Student 13", "Student 14", "Student 15",
                "Student 16", "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            4 => [
                "Hà Hoàng Tú", "A Lăng Quyên", "Pơ Loong Trung", "Kring Trãi",
                // Thêm học sinh mẫu để đủ 21
                "Student 5", "Student 6", "Student 7", "Student 8", "Student 9", "Student 10",
                "Student 11", "Student 12", "Student 13", "Student 14", "Student 15", "Student 16",
                "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            5 => array_map(fn($i) => "Student $i", range(1, 21)), // Chưa có tên thật
            6 => array_map(fn($i) => "Student $i", range(1, 21)), // Chưa có tên thật
        ];

        // Thêm học sinh vào DB
        foreach ($students as $classId => $names) {
            foreach ($names as $index => $name) {
                // Bỏ qua 2 học sinh mẫu bạn đã có trong lớp 1 và 2 (email student1, student2)
                // để tránh trùng email
                if (
                    ($classId === 1 && in_array($name, ['Student One'])) ||
                    ($classId === 2 && in_array($name, ['Student Two']))
                ) {
                    continue;
                }

                DB::table('users')->insert([
                    'name' => $name,
                    'email' => 'student' . $classId . '_' . ($index + 1) . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'student',
                    'class_id' => $classId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
