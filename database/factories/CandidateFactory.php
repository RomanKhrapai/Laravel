<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
use App\Models\Nature;
use App\Models\Type;
use App\Models\User;
use App\Models\Profession;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::get()->random()->id,
            'title' => fake()->word(),
            'description' => fake()->paragraph(),
            'area_id' => Area::get()->random()->id,
            'nature_id' => Nature::get()->random()->id,
            'profession_id' => Profession::get()->random()->id,
            'salary' => fake()->numberBetween(1000, 50000)
        ];
    }
}
