<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'Sourdough Bread', 'Whole Wheat Bread', 'Rye Bread', 'Ciabatta',
            'Baguette', 'Brioche', 'Focaccia', 'Challah', 'Pumpernickel',
            'Multigrain Bread', 'Irish Soda Bread', 'Pita Bread',
            'Naan Bread', 'Cornbread', 'English Muffin', 'Bagel',
            'Croissant', 'Kaiser Roll', 'Pretzel Bread', 'Potato Bread',
            'Garlic Bread', 'Flatbread', 'Breadsticks', 'Dinner Rolls',
            'Banana Bread', 'Zucchini Bread', 'Olive Bread',
            'Walnut Bread', 'Raisin Bread', 'Gluten-Free Bread'
        ];

        return [
            'name' => fake()->randomElement($products),
            'price' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
