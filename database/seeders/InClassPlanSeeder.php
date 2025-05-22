<?php

namespace Database\Seeders;

use App\Models\InClassPlan;
use App\Models\WeeklyStudyPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InClassPlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('in_class_plans')->insert([
            'weekly_study_plan_id' => 1,
        ]);
    }
}
