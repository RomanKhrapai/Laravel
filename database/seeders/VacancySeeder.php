<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('vacancies')->insert([
            [
                'company_id' => 1,
                'title' => 'fake()->word()',
                'description' => 'fake()->paragraph()',
                'type_id' => 1,
                'nature_id' => 1,
                'salary' => 1000,
                'max_salary' => 2000
            ],

        ]);
    }
}
