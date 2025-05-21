<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JournalsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('journals')->insert([
            [
                'user_id' => 4,
                'inclass_id' => 1,
                'selfstudy_id' => 1,
            ],
            [
                'user_id' => 4,
                'inclass_id' => 1,
                'selfstudy_id' => 1,
            ],
            [
                'user_id' => 4,
                'inclass_id' => 1,
                'selfstudy_id' => 1,
                
            ],
            [
                'user_id' => 5,
                'inclass_id' => 2,
                'selfstudy_id' => 2,
            ],
            [
                'user_id' => 5,
                'inclass_id' => 2,
                'selfstudy_id' => 2,
            ],
        ]);
    }
}
