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

            ['name' => 'company.viewAny', 'description' => ''],
            ['name' => 'company.view', 'description' => ''],
            ['name' => 'company.create', 'description' => ''],
            ['name' => 'company.update', 'description' => ''],
            ['name' => 'company.delete', 'description' => ''],
            ['name' => 'company.restore', 'description' => ''],
            ['name' => 'company.forceDelete', 'description' => ''],

            ['name' => 'vacancy.viewAny', 'description' => ''],
            ['name' => 'vacancy.view', 'description' => ''],
            ['name' => 'vacancy.create', 'description' => ''],
            ['name' => 'vacancy.update', 'description' => ''],
            ['name' => 'vacancy.delete', 'description' => ''],
            ['name' => 'vacancy.restore', 'description' => ''],
            ['name' => 'vacancy.forceDelete', 'description' => ''],

            ['name' => 'role.viewAny', 'description' => ''],
            ['name' => 'role.view', 'description' => ''],
            ['name' => 'role.create', 'description' => ''],
            ['name' => 'role.update', 'description' => ''],
            ['name' => 'role.delete', 'description' => ''],
            ['name' => 'role.restore', 'description' => ''],
            ['name' => 'role.forceDelete', 'description' => ''],

            ['name' => 'area.viewAny', 'description' => ''],
            ['name' => 'area.view', 'description' => ''],
            ['name' => 'area.create', 'description' => ''],
            ['name' => 'area.update', 'description' => ''],
            ['name' => 'area.delete', 'description' => ''],
            ['name' => 'area.restore', 'description' => ''],
            ['name' => 'area.forceDelete', 'description' => ''],

            ['name' => 'nature.viewAny', 'description' => ''],
            ['name' => 'nature.view', 'description' => ''],
            ['name' => 'nature.create', 'description' => ''],
            ['name' => 'nature.update', 'description' => ''],
            ['name' => 'nature.delete', 'description' => ''],
            ['name' => 'nature.restore', 'description' => ''],
            ['name' => 'nature.forceDelete', 'description' => ''],

            ['name' => 'type.viewAny', 'description' => ''],
            ['name' => 'type.view', 'description' => ''],
            ['name' => 'type.create', 'description' => ''],
            ['name' => 'type.update', 'description' => ''],
            ['name' => 'type.delete', 'description' => ''],
            ['name' => 'type.restore', 'description' => ''],
            ['name' => 'type.forceDelete', 'description' => ''],

            ['name' => 'skill.viewAny', 'description' => ''],
            ['name' => 'skill.view', 'description' => ''],
            ['name' => 'skill.create', 'description' => ''],
            ['name' => 'skill.update', 'description' => ''],
            ['name' => 'skill.delete', 'description' => ''],
            ['name' => 'skill.restore', 'description' => ''],
            ['name' => 'skill.forceDelete', 'description' => ''],

            ['name' => 'profession.viewAny', 'description' => ''],
            ['name' => 'profession.view', 'description' => ''],
            ['name' => 'profession.create', 'description' => ''],
            ['name' => 'profession.update', 'description' => ''],
            ['name' => 'profession.delete', 'description' => ''],
            ['name' => 'profession.restore', 'description' => ''],
            ['name' => 'profession.forceDelete', 'description' => ''],
        ]);
    }
}
