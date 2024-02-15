<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user1 = User::where('role_id', 3)->get()->random();
        $user2 = User::where('role_id', 2)->get()->random();
        $randomCompany = $user2->companies->random();
        Log::info($randomCompany);
        Log::info($user1);
        Log::info($user2);
        return [
            'parent_id' => null,
            // 'user_id' => $user2->id,
            'user_id' => $user1->id,
            // 'company_id' => $randomCompany->id,
            // 'evaluated_user_id' =>  13,
            // 'evaluated_user_id' =>  $user1->id,
            'evaluated_company_id' => $randomCompany->id,
            'vote' => fake()->numberBetween(1, 10),
            'review' => fake()->paragraph(),
        ];
    }
}
