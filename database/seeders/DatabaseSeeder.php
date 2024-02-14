<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Area;
use App\Models\Candidate;
use App\Models\Profession;
use App\Models\Company;
use App\Models\SkillVacancy;
use App\Models\CandidateSkill;
use App\Models\Skill;
use App\Models\Vacancy;

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
            RoleSeeder::class,
            UserSeeder::class,
            // CompanySeeder::class,
            TypeSeeder::class,
            PermisionSeeder::class,
            ProfessionSeeder::class,
            // VacancySeeder::class,
            PermissionRoleSeeder::class
        ]);

        User::factory(10)->create();
        // Company::factory(12)->create();

        // Area::factory(6)->create();
        // Profession::factory(3)->create();
        // Skill::factory(60)->create();
        // Vacancy::factory(20)->create();
        // Candidate::factory(20)->create();


        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
        // SkillVacancy::factory(1)->create();
        // CandidateSkill::factory(1)->create();
    }
}
