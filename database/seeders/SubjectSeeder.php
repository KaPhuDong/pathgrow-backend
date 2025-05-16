<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('subjects')->insert([
            [
                'name' => 'TOEIC 1',
                'description' => 'Test of English for International Communication.',
            ],
            [
                'name' => 'IT English 2',
                'description' => 'Study of information technology terminology and communication in English.',
            ],
            [
                'name' => 'Communicative English',
                'description' => 'Development of speaking and listening skills in English.',
            ],
            
        ]);
    }
}
