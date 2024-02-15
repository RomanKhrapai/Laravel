<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Company;
use App\Models\Nature;
use App\Models\Profession;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $salary = fake()->numberBetween(100, 5000);
        $maxSalary =  fake()->numberBetween(0, 1) == 1 ? fake()->numberBetween($salary, 6000) : null;
        $nameJob = fake()->jobTitle();
        return [
            'company_id' => Company::get()->random()->id,
            'title' => $nameJob . fake()->word(2),
            'description' => fake()->realTextBetween($minNbChars = 160, $maxNbChars = 2000, $indexSize = 2),
            'area_id' => Area::get()->random()->id,
            'type_id' => Type::get()->random()->id,
            'nature_id' => Nature::get()->random()->id,
            'profession_id' => Profession::get()->random()->id,
            'salary' => $salary,
            'max_salary' => $maxSalary,
            'closed' => true,
        ];
    }
}
