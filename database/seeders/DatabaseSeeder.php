<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Area;
use App\Models\Category;
use App\Models\Employment;
use App\Models\Experience;
use App\Models\Skill;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        $this->call([
            NatureSeeder::class,
            DegreeSeeder::class,
            RoleSeeder::class,
            TypeSeeder::class,
            LanguagesSeeder::class

        ]);

        User::factory(10)->create();
        Area::factory(6)->create();
        Category::factory(3)->create();
        Employment::factory(4)->create();
        Experience::factory(3)->create();
        Skill::factory(7)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
