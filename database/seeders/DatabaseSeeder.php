<?php

namespace Database\Seeders;

use App\Models\StudentCalendar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassSeeder::class,
            SemesterSeeder::class,
            SubjectSeeder::class,
            UsersTableSeeder::class,
            SemesterGoalSeeder::class,
            WeeklyStudyPlanSeeder::class,
            WeeklyGoalSeeder::class,
            SelfStudyPlanSeeder::class,
            SelfStudySubjectSeeder::class,
            InClassPlanSeeder::class,
            InClassSubjectSeeder::class,
            StudentCalendarSeeder::class,
        ]);
    }
}
