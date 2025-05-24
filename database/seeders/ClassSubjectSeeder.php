<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSubjectSeeder extends Seeder
{
    public function run(): void
    {
        // Danh sách quan hệ class_id - subject_id (ví dụ gán 3 môn cho mỗi lớp)
        $mappings = [
            // PNV 27A
            ['class_id' => 1, 'subject_id' => 1],
            ['class_id' => 1, 'subject_id' => 2],
            ['class_id' => 1, 'subject_id' => 3],

            // PNV 27B
            ['class_id' => 2, 'subject_id' => 1],
            ['class_id' => 2, 'subject_id' => 2],

            // PNV 26A
            ['class_id' => 3, 'subject_id' => 2],
            ['class_id' => 3, 'subject_id' => 3],

            // PNV 26B
            ['class_id' => 4, 'subject_id' => 1],
            ['class_id' => 4, 'subject_id' => 3],

            // PNV 25A
            ['class_id' => 5, 'subject_id' => 1],
            ['class_id' => 5, 'subject_id' => 2],
            ['class_id' => 5, 'subject_id' => 3],

            // PNV 25B
            ['class_id' => 6, 'subject_id' => 2],
        ];

        foreach ($mappings as $mapping) {
            DB::table('class_subject')->insert([
                'class_id' => $mapping['class_id'],
                'subject_id' => $mapping['subject_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
