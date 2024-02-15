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
        $nameJob = fake()->jobTitle();
        return [
            'user_id' => User::where('role_id', 3)->get()->random()->id,
            'title' =>  $nameJob . fake()->sentence(3),
            'description' => fake()->realTextBetween($minNbChars = 160, $maxNbChars = 2000, $indexSize = 2),
            'area_id' => Area::get()->random()->id,
            'nature_id' => Nature::get()->random()->id,
            'profession_id' => Profession::get()->random()->id,
            'salary' => fake()->numberBetween(100, 6000),
            'experience_months' => fake()->numberBetween(1, 60),
        ];
    }
}
