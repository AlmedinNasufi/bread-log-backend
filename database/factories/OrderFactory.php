<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;
    public function definition(): array
    {
        $user = User::factory()
            ->has(UserInfo::factory())
            ->create();

        $product = Product::factory()->create();
        $quantity = fake()->numberBetween(1, 10);

        return [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
            'order_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'payment_status' => fake()->randomElement(['paid', 'unpaid']),
            'product_name' => $product->name,
            'user_name' => $user->first_name . ' ' . $user->last_name,
        ];
    }
}
