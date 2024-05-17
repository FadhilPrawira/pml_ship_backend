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
    public function run()
    {
        $totalPorts = 61; // Jumlah total pelabuhan



        // Membuat kombinasi rute antara pelabuhan-pelabuhan yang tersedia
        for ($origin = 1; $origin <= $totalPorts; $origin++) {
            for ($destination = 1; $destination <= $totalPorts; $destination++) {
                // Jika pelabuhan asal tidak sama dengan pelabuhan tujuan
                if ($origin != $destination) {
                    // Simpan rute ke database menggunakan factory
                    VesselRoute::factory()->create(
                        [
                            'port_of_loading_id' => $origin,
                            'port_of_discharge_id' => $destination,
                        ]

                    );

                }
            }
        }
    }
}
