<?php

namespace App\Console\Commands;

use App\Models\Vessel;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateVesselLastLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-vessel-last-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update vessel last location from PML API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Initialize a new Guzzle client
        $client = new Client();

        // Get the API username and password from .env, if not exist, use empty string as default so the request will fail
        $username = env('PML_API_USERNAME', '');
        $password = env('PML_API_PASSWORD', '');

        $url = 'https://www.vms.web.id/vmap/api/get.php?user=' . $username . '&pass=' . $password . '&type=1&d=2&vessel=0';

        // Params

        // This is from PT PML IT Support, I dont know what this is
        $queryParams = [
            "user" => $username,
            "pass" => $password,
            "type" => "2", // I dont know what this is
            "d" => "2", // I dont know what this is
            "d1" => "2024-05-01", // start date
            "d2" => "2024-05-01", // end date
            "vessel" => "0" // I dont know what this is
        ];

        // Do the request
        $response = $client->request('GET', $url, [
            'verify' => false,
            // 'query' => $queryParams,
        ]);

        // Alternate way to do the request, not really working.
        // $response = $client->request('GET', $url, ['verify' => base_path('cacert.pem')]);

        // Get the content of the response
        $content = $response->getBody()->getContents();

        // Decode the content to an array
        $contentArray = json_decode($content, true);

        // Current time
        $currentDateTime = Carbon::now();

        // Floor to the nearest hour
        $floorDateTime = $currentDateTime->minute(0)->second(0);



        // Define the start and end of the date range
        $startDate = $floorDateTime->copy()->subHour(1);
        $endDate = $floorDateTime->copy()->subSecond(1);

        // Initialize an array to keep track of the latest entries
        $latestEntries = [];

        foreach ($contentArray['data'] as $entry) {
            $entryDate = DateTime::createFromFormat('Y-m-d H:i:s', $entry['date']);
            $txid = $entry['txid'];

            // Check if the entry date is within the specified range
            if ($entryDate >= $startDate && $entryDate <= $endDate) {

                // If the txid is not in the latestEntries array or the entry is more recent, update the latestEntries array
                if (!isset($latestEntries[$txid]) || $entryDate > DateTime::createFromFormat('Y-m-d H:i:s', $latestEntries[$txid]['date'])) {

                    // Add the entry to the latestEntries array
                    $latestEntries[] = $entry;
                }
            }
        }

        // Insert the latest entries into the database using the Vessel model
        foreach ($latestEntries as $entry) {

            // Find the vessel by internal ID
            $vessel = Vessel::where('pml_internal_vessel_id', $entry['vessel_id'])->first();

            if ($vessel) {
                // Reset specific fields to null
                $vessel->update([
                    'vessel_lat' => null,
                    'vessel_lon' => null,
                    'vessel_vts_speed_knot' => null,
                    'vessel_calc_speed_knot' => null,
                    'vessel_heading_degree' => null,
                    'pml_last_updated_at' => null,
                ]);
            }

            // Update the vessel if there is a match in txid or create the vessel data if there is no match
            Vessel::updateOrCreate(
                ['pml_internal_vessel_id' => $entry['vessel_id']],
                [
                    'vessel_tx_id' => $entry['txid'],
                    'vessel_name' => $entry['name'],
                    'vessel_lat' => $entry['lat'],
                    'vessel_lon' => $entry['lon'],
                    'vessel_vts_speed_knot' => $entry['speed'],
                    'vessel_calc_speed_knot' => $entry['calcspeed'],
                    'vessel_heading_degree' => $entry['heading'],
                    'pml_last_updated_at' => $entry['date'],
                ]
            );
        }

        // Count inserted data
        $this->comment('Inserted ' . count($latestEntries) . ' vessels data.');
        $this->info('Vessels updated successfully!');
    }
}
