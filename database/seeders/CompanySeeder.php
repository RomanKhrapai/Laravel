<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'fake()->name()',
                'address' => 'fake()->word()',
                'description' => 'fake()->paragraph()',
                'image' => 'fake()->word()',
                'user_id' => 1,
            ],

        ]);
    }
}
