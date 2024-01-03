<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('degrees')->insert([
            ['name' => "Дошкільна освіта", 'value' => 1],
            ['name' => 'Повна загальна середня освіта', 'value' => 2],
            ['name' => 'Професійна (професійно-технічна) освіта', 'value' => 3],
            ['name' => 'Фахова передвища освіта', 'value' => 4],
            ['name' => 'Вища освіта', 'value' => 5]
        ]);
    }
}
