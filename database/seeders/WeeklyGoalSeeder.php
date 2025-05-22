<?php

namespace Database\Seeders;

use App\Models\WeeklyGoal;
use App\Models\WeeklyStudyPlan;
use Illuminate\Database\Seeder;

class WeeklyGoalSeeder extends Seeder
{
    public function run(): void
    {
        $weeklyPlan = WeeklyStudyPlan::first();

        WeeklyGoal::insert([
            [
                'weekly_study_plan_id' => $weeklyPlan->id,
                'name' => 'Finish reading unit 1',
            ],
            [
                'weekly_study_plan_id' => $weeklyPlan->id,
                'name' => 'Practice listening daily',
            ],
        ]);
    }
}
