<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "fake()->name()",
                'email' => 'dsfdsf@fdsfd.dsf',
                'password' => 'static::$password ??= Hash::make(password)',
                'remember_token' => 'Str::random(10)',
                'role_id' => 1,
            ],

        ]);
    }
}
