<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InClassSubjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('in_class_subject')->insert([
            [
                'in_class_plan_id' => 1,
                'date' => now()->toDateString(),
                'subject_id' => 1,
                'my_lesson' => 'Learned Laravel Routing',
                'self_assessment' => 2,
                'my_difficulties' => 'Still confused about Route::resource',
                'my_plan' => 'Practice simple route grouping',
                'problem_solved' => 'Not yet',
            ],
            [
                'in_class_plan_id' => 1,
                'date' => now()->toDateString(),
                'subject_id' => 2,
                'my_lesson' => 'CSS Grid layout',
                'self_assessment' => 3,
                'my_difficulties' => null,
                'my_plan' => null,
                'problem_solved' => 'Yes',
            ],
        ]);
    }
}
