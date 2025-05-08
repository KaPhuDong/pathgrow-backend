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
    }
}
