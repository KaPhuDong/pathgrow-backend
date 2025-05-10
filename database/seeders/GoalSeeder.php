<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Tạo user nếu chưa có
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password')
            ]
        );

        // Insert goals
        DB::table('goals')->insert([
            [
                'user_id' => $user->id,
                'title' => 'IT English - Improve Technical Vocabulary',
                'description' => 'Learn 50 new IT-related English terms.',
                'start_date' => '2025-05-01',
                'end_date' => '2025-05-10',
                'status' => 'in_progress',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'title' => 'TOEIC - Listening Practice',
                'description' => 'Complete 10 TOEIC listening tests.',
                'start_date' => '2025-05-02',
                'end_date' => '2025-05-12',
                'status' => 'not_started',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Community English - Presentation Skills',
                'description' => 'Prepare and deliver a 5-minute talk in English.',
                'start_date' => '2025-05-03',
                'end_date' => '2025-05-15',
                'status' => 'completed',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
