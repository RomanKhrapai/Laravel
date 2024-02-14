<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('professions')->insert([
            ['name' => "programmer"],
            ['name' => 'electrician'],
            ['name' => 'plasterer'],
            ['name' => 'welder']
        ]);
    }
}



