<?php

namespace Database\Factories;

use App\Models\Employment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->paragraph(),
            'employment_id' => Employment::get()->random()->id,
            'months' => fake()->numberBetween(6, 66),
            'name' => fake()->word()
        ];
    }
}
