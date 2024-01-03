<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employment>
 */
class EmploymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::get()->random()->id,
            'description' => fake()->paragraph(),
            'experience' => rand(1, 5),
            'interests' => fake()->paragraph(),
            'salary_min' => fake()->numberBetween(1000, 5000),
            'title' => fake()->sentence(),
        ];
    }
}
