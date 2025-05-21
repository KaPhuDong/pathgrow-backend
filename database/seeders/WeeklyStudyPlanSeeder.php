<?php

namespace Database\Seeders;

use App\Models\WeeklyStudyPlan;
use App\Models\User;
use Illuminate\Database\Seeder;

class WeeklyStudyPlanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        WeeklyStudyPlan::create([
            'student_id' => $user->id,
            'start_date' => now()->startOfWeek(),
            'end_date' => now()->endOfWeek(),
        ]);
    }
}
