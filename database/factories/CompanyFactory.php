<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $imageUrls = [
            'images/companies/avatars/2company.jpg',
            'images/companies/avatars/3company.jpg',
            'images/companies/avatars/1company.jpg',
            'images/companies/avatars/4company.jpg',
            'images/companies/avatars/5company.jpg',
            'images/companies/avatars/6company.jpg',
            'images/companies/avatars/7company.jpg',
            'images/companies/avatars/8company.jpg',
            'images/companies/avatars/9company.jpg',
            'images/companies/avatars/10company.jpg',
            'images/companies/avatars/11company.jpg',
            'images/companies/avatars/12company.jpg',
            'images/companies/avatars/13company.jpg',
            'images/companies/avatars/14company.jpg',
            'images/companies/avatars/15company.jpg',
            'images/companies/avatars/16company.jpg',
            'images/companies/avatars/17company.jpg',
            'images/companies/avatars/18company.jpg',
            'images/companies/avatars/19company.jpg',
            'images/companies/avatars/20company.jpg',
            'images/companies/avatars/21company.jpg',
            'images/companies/avatars/22company.jpg',
            'images/companies/avatars/23company.jpg',
            'images/companies/avatars/24company.jpg',
            'images/companies/avatars/25company.jpg',
            'images/companies/avatars/26company.jpg',
            'images/companies/avatars/27company.jpg',
            'images/companies/avatars/28company.jpg',
            'images/companies/avatars/29company.jpg',
        ];
        return [
            'name' => fake()->company(),
            'address' => fake()->streetAddress(),
            'description' => fake()->realTextBetween($minNbChars = 160, $maxNbChars = 2000, $indexSize = 2),
            'image' => $this->faker->randomElement($imageUrls),
            'user_id' => User::where('role_id', 2)->get()->random()->id,
        ];
    }
}
