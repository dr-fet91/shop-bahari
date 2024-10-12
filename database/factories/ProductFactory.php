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
        return [
            'name' => $this->faker->unique()->word,
            'title' => $this->faker->unique()->sentence(3),
            'image' => $this->faker->imageUrl(640, 480, 'shop'),
            'price' => $this->faker->randomFloat(2, 10000, 10000000),
            'add_type' => $this->faker->randomElement(['sele', 'buy']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
