<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('classes')->insert([
            [
                'name' => 'PNV 27A',
                'students' => 21,
                'color' => '#facc15',
                'slug' => 'pnv-27a',
            ],
            [
                'name' => 'PNV 27B',
                'students' => 21,
                'color' => '#d1d5db',
                'slug' => 'pnv-27b',
            ],
            [
                'name' => 'PNV 26A',
                'students' => 21,
                'color' => '#f472b6',
                'slug' => 'pnv-26a',
            ],
            [
                'name' => 'PNV 26B',
                'students' => 21,
                'color' => '#67e8f9',
                'slug' => 'pnv-26b',
            ],
            [
                'name' => 'PNV 25A',
                'students' => 21,
                'color' => '#f9a8d4',
                'slug' => 'pnv-25a',
            ],
            [
                'name' => 'PNV 25B',
                'students' => 21,
                'color' => '#67e8f9',
                'slug' => 'pnv-25b',
            ],
        ]);
    }
}
