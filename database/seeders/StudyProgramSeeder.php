<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudyProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            ['D3', 'Akuntansi'],
            ['D3', 'Manajemen Perusahaan'],
            ['S1', 'Manajemen'],
            ['S1', 'Akuntansi'],
            ['D4', 'Akuntansi Perpajakan'],
            ['S1', 'Bisnis Digital'],
            ['S1', 'Pariwisata'],
            ['S2', 'Manajemen'],
        ];

        foreach ($programs as $i => [$degree, $name]) {
            StudyProgram::updateOrCreate(
                ['slug' => Str::slug($degree . ' ' . $name)],
                [
                    'name' => $name,
                    'degree' => $degree,
                    'sort_order' => $i + 1,
                ]
            );
        }
    }
}