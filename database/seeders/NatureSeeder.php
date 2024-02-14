<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('natures')->insert([
            ['name' => "In the office / on site"],
            ['name' => 'Distant'],
            ['name' => 'Hybrid']
        ]);
        //
    }
}
