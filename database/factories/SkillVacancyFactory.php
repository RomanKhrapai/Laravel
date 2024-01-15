<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SkillVacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vacancy_id' =>  Vacancy::get()->random()->id,
            'skill_id' =>  Skill::get()->random()->id,

        ];
    }
}
