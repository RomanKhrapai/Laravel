<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'user.viewAny', 'description' => ''],
            ['name' => 'user.view', 'description' => ''],
            ['name' => 'user.create', 'description' => ''],
            ['name' => 'user.update', 'description' => ''],
            ['name' => 'user.delete', 'description' => ''],
            ['name' => 'user.restore', 'description' => ''],
            ['name' => 'user.forceDelete', 'description' => ''],
        ]);
    }
}
