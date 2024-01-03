<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            ['name' => "Українська", 'active' => true],
            ['name' => 'Англійська', 'active' => true],
            ['name' => 'Німецька', 'active' => true],
            ['name' => 'Китайська', 'active' => true],
            ['name' => 'Французька', 'active' => true],
        ]);
    }
}
