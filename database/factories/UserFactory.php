<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        $nextId = User::max('id') + 1;
        $imageUrls = [
            'images/users/avatars/user1.jpg',
            'images/users/avatars/user2.jpg',
            'images/users/avatars/user3.jpg',
            'images/users/avatars/user4.jpg',
            'images/users/avatars/user5.jpg',
            'images/users/avatars/user6.jpg',
            'images/users/avatars/user7.jpg',
            'images/users/avatars/user8.jpg',
            'images/users/avatars/user9.jpg',
            'images/users/avatars/user10.jpg',
            'images/users/avatars/user11.jpg',
            'images/users/avatars/user12.jpg',
            'images/users/avatars/user13.jpg',
        ];
        $roleIds = [2, 3, 3, 3, 3, 3];

        return [
            'name' => fake()->name(),
            'email' => 'user' . $nextId . '@mail.com',
            'password' => static::$password ??= Hash::make('1q2w3e4r'),
            'image' => $this->faker->randomElement($imageUrls),
            'remember_token' => Str::random(10),
            'role_id' => $this->faker->randomElement($roleIds),
            'telephone' => fake()->unique()->numerify('+3 ### ###-####'),
        ];
    }
}
