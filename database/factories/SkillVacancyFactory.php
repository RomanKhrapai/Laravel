<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SkillVacancy;

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
        $vacancy = Vacancy::get()->random();
        $professionId = $vacancy->profession_id;

        $skill = Skill::where('profession_id', $professionId)->inRandomOrder()->first();

        $uniqueCheck = SkillVacancy::where('vacancy_id', $vacancy->id)
            ->where('skill_id', $skill->id)
            ->count();

        while ($uniqueCheck > 0) {
            $vacancy = Vacancy::get()->random();
            $professionId = $vacancy->profession_id;
            $skill = Skill::where('profession_id', $professionId)->inRandomOrder()->first();

            $uniqueCheck = SkillVacancy::where('vacancy_id', $vacancy->id)
                ->where('skill_id', $skill->id)
                ->count();
        }

        return [
            'vacancy_id' => $vacancy->id,
            'skill_id' => $skill->id,
        ];
    }
}
