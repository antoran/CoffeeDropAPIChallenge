<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'postcode' => $this->faker->postcode,
            'times' => [
                'opening_times' => [
                    'monday' => '09:00',
                    'tuesday' => '09:00',
                    'saturday' => '08:30',
                ],
                'closing_times' => [
                    'monday' => '19:00',
                    'tuesday' => '19:00',
                    'saturday' => '18:30',
                ],
            ],
        ];
    }
}
