<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Company;
use App\Models\Nature;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        $salary = fake()->numberBetween(1000, 50000);
        $maxSalary =  fake()->numberBetween(0, 1) == 1 ? fake()->numberBetween($salary, 60000) : null;
        return [
            'company_id' => Company::get()->random()->id,
            'title' => fake()->word(),
            'description' => fake()->paragraph(),
            'area_id' => Area::get()->random()->id,
            'type_id' => Type::get()->random()->id,
            'nature_id' => Nature::get()->random()->id,
            'salary' => $salary,
            'max_salary' => $maxSalary
        ];
    }
}
