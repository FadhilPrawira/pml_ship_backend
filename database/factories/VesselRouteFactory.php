<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VesselRoute>
 */
class VesselRouteFactory extends Factory
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

//            Maximum day from Open Meteo for forecast is 16 days
            'day_estimation' => random_int(1, 16),
            'cost' => random_int(1, 10) . '000000'

        ];
    }
}
