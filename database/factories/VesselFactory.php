<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vessel>
 */
class VesselFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            factory
            'vessel_name' => $this->faker->name,
            'vessel_type' => $this->faker->name,
//            'imo_number' => $this->faker->name,
//            'mmsi_number' => $this->faker->name,
            'vessel_status' => ['onhire', 'offhire'][random_int(0, 1)],
            'vessel_lat' => $this->faker->latitude,
            'vessel_lon' => $this->faker->longitude,
            'vessel_vts_speed_knot' => random_int(1, 10),
            'vessel_calc_speed_knot' => random_int(1, 10),
            'vessel_heading_degree' => random_int(0, 360),
            'vessel_tx_id' => $this->faker->phoneNumber,
        ];
    }
}
