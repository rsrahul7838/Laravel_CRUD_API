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
            'product_id'=> fake()->randomNumber(),
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(100,1000),            
            'category' => ucfirst($this->faker->word), 
            'brand'=>fake()->company(),
        ];
    }
}
