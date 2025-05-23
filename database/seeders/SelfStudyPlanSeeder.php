<?php

namespace Database\Seeders;

use App\Models\SelfStudyPlan;
use App\Models\WeeklyStudyPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelfStudyPlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('self_study_plans')->insert([
            'weekly_study_plan_id' => 1,
        ]);
    }
}