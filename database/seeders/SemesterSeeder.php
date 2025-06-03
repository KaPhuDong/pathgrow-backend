<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        
        DB::table('semesters')->insert([
            [
                'name' => 'Semester 1',
            ],
            [
                'name' => 'Semester 2',
            ],
            [
                'name' => 'Semester 3',
            ],
            [
                'name' => 'Semester 4',
            ],
            [
                'name' => 'Semester 5',
            ],
            [
                'name' => 'Semester 6',
            ],
        ]);
    }
}
