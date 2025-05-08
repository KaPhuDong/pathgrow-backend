<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('classes')->insert([
            ['id' => 1, 'name' => 'PNV26A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'PNV26B', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
