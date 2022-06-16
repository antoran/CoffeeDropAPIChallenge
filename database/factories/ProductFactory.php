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
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'prices' => [
                '0' => $this->faker->randomFloat(2, 0, 1),
                '51' => $this->faker->randomFloat(2, 0, 1),
                '501' => $this->faker->randomFloat(2, 0, 1),
            ]
        ];
    }
}
