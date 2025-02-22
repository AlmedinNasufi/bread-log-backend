<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInfo>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = UserInfo::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
