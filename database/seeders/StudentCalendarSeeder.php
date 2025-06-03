<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentCalendarSeeder extends Seeder
{
    public function run()
    {
        // Giả sử bạn có user_id = 1 trong bảng users
        $userId = 1;

        DB::table('student_calendars')->insert([
            [
                'user_id' => $userId,
                'title' => 'It English',
                'day_of_week' => 'Monday',
                'date' => '2025-05-19',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'color' => '#cfe9ff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'title' => 'Practice TOEIC',
                'day_of_week' => 'Wednesday',
                'date' => '2025-05-21',
                'start_time' => '14:00:00',
                'end_time' => '15:30:00',
                'color' => '#ffe5cc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'title' => 'Communicative',
                'day_of_week' => 'Friday',
                'date' => '2025-05-23',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
                'color' => '#e6ccff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
