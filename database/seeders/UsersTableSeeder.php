<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
       // Create an Admin, 2 sample teachers, and 2 sample students
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'class_id' => null,
                'avatar' => 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
                'avatar_public_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teacher One',
                'email' => 'teacher1@example.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'class_id' => 1,
                'avatar' => 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
                'avatar_public_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teacher Two',
                'email' => 'teacher2@example.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'class_id' => 2,
                'avatar' => 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
                'avatar_public_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student One',
                'email' => 'student1@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'class_id' => 1,
                'avatar' => 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
                'avatar_public_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student Two',
                'email' => 'student2@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'class_id' => 2,
                'avatar' => 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
                'avatar_public_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

         // List of students in each class
        $students = [
            1 => [
                "Zoăn Thị Bằng", "Y Xa Bế", "Coor Chăng", "Phạm Đức Đạt", "Trần Công Đoàn",
                "Nguyễn Thị Kim Tuyên", "Hồ Thị Duyên Hà", "Ngô Thị Kim Hân", "Hồ Văn Hạnh",
                "Huỳnh Hữu Hậu",
                "Student 11", "Student 12", "Student 13", "Student 14", "Student 15",
                "Student 16", "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            2 => [
                "Zo Râm Thị Phấn", "Hồ Tư Hãn", "Hồ Thị Kim", "Zo Râm Tuyền",
                "Student 5", "Student 6", "Student 7", "Student 8", "Student 9", "Student 10",
                "Student 11", "Student 12", "Student 13", "Student 14", "Student 15", "Student 16",
                "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            3 => [
                "Un Hoàng Phương Anh", "Đinh Tuấn Vỹ", "Hồ Thị Huệ",
                "Student 4", "Student 5", "Student 6", "Student 7", "Student 8", "Student 9",
                "Student 10", "Student 11", "Student 12", "Student 13", "Student 14", "Student 15",
                "Student 16", "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            4 => [
                "Hà Hoàng Tú", "A Lăng Quyên", "Pơ Loong Trung", "Kring Trãi",
                "Student 5", "Student 6", "Student 7", "Student 8", "Student 9", "Student 10",
                "Student 11", "Student 12", "Student 13", "Student 14", "Student 15", "Student 16",
                "Student 17", "Student 18", "Student 19", "Student 20", "Student 21",
            ],
            5 => array_map(fn($i) => "Student $i", range(1, 21)),
            6 => array_map(fn($i) => "Student $i", range(1, 21)),
        ];

       // Insert students into the database
        foreach ($students as $classId => $names) {
            foreach ($names as $index => $name) {
                 // Skip 2 sample students added above (student1@example.com and student2@example.com)
                if (
                    ($classId === 1 && $index === 0) || // Duplicate of Student One
                    ($classId === 2 && $index === 0)    // Duplicate of Student Two
                ) {
                    continue;
                }

                $email = 'student' . $classId . '_' . ($index + 1) . '@example.com';

                DB::table('users')->insert([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'role' => 'student',
                    'class_id' => $classId,
                    'avatar' => 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
                    'avatar_public_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
