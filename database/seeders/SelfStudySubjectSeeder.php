<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelfStudySubjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('self_study_subject')->insert([
            [
                'self_study_plan_id' => 1,
                'date' => now()->toDateString(),
                'subject_id' => 1,
                'my_lesson' => 'Learned basic PHP syntax',
                'time_allocation' => '2 hours',
                'learning_resources' => 'PHP Manual, YouTube tutorial',
                'learning_activities' => 'Reading, Practice coding',
                'concentration' => 'Yes',
                'plan_follow_reflection' => 'Yes',
                'evaluation' => 'Good understanding of variables and loops',
                'reinforcing_learning' => 'Reviewed by redoing exercises',
                'notes' => 'Need to practice more on arrays',
            ],
            [
                'self_study_plan_id' => 1,
                'date' => now()->toDateString(),
                'subject_id' => 2,
                'my_lesson' => 'Revised basic CSS positioning',
                'time_allocation' => '1.5 hours',
                'learning_resources' => 'MDN, CSS-Tricks',
                'learning_activities' => 'Reading, Making demo layout',
                'concentration' => 'Not sure',
                'plan_follow_reflection' => 'Yes',
                'evaluation' => 'Still confused with flexbox',
                'reinforcing_learning' => 'Watch another Flexbox video',
                'notes' => 'Repeat exercise tomorrow',
            ],
        ]);
    }
}
