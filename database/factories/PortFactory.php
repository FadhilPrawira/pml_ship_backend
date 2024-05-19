<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Port>
 */
class PortFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // factory
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
//            'latitude' => $this->faker->latitude(),
//            'longitude' => $this->faker->longitude(),
            'open_time' => $this->faker->time(),
            'close_time' => $this->faker->time(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
