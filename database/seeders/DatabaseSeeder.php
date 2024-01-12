<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Area;
use App\Models\Category;
use App\Models\Company;
use App\Models\Employment;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Vacancy;
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
            UserSeeder::class,
            CompanySeeder::class,
            TypeSeeder::class,
            LanguagesSeeder::class,
            PermisionSeeder::class,
            VacancySeeder::class
        ]);

        User::factory(10)->create();
        Company::factory(12)->create();

        Area::factory(6)->create();
        Category::factory(3)->create();
        Employment::factory(4)->create();
        Experience::factory(3)->create();
        Skill::factory(7)->create();
        Vacancy::factory(20)->create();
    }
}
