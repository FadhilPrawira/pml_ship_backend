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

//            Maximum day from Open Meteo for forecast is 15 days
            'day_estimation' => random_int(1, 15),
            'shipping_cost' => random_int(1, 10) . '0000000000',
            'handling_cost' => random_int(1, 10) . '0000000',
            'biaya_parkir_pelabuhan' => random_int(1, 10) . '0000000',

        ];
    }
}
