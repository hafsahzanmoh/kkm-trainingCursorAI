<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['car', 'motorcycle', 'bus', 'truck']),
            'platenumber' => fake()->randomNumber(6),
            'passanger' => fake()->numberBetween(1, 10),
        ];
    }
}
