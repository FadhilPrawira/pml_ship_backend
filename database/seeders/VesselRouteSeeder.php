<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VesselRoute;

class VesselRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VesselRoute::factory()->create(
            [
                'port_of_loading_id' => '5',
                'port_of_discharge_id'=>'60'
            ]

        );
        VesselRoute::factory()->create(
            [
                'port_of_loading_id' => '5',
                'port_of_discharge_id'=>'12'
            ]

        );
        VesselRoute::factory()->create(
            [
                'port_of_loading_id' => '5',
                'port_of_discharge_id'=>'30'
            ]

        );

    }
}
