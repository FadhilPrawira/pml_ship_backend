<?php

namespace App\Console\Commands;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Console\Command;


class UpdateCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency from FreeCurrencyAPI';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $client = new Client();

        // Convert from USD to IDR
        $base_currency = 'USD';
        $currencies = 'IDR';

        // Get the API key from .env, if not exist, use empty string as default so the request will fail
        $freecurrency_api_key = env('FREECURRENCY_API_KEY', '');
        $url = 'https://api.freecurrencyapi.com/v1/latest?apikey=' . $freecurrency_api_key . '&base_currency=' . $base_currency . '&currencies=' . $currencies;

        // Do the request
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        // Search for the currency in the database with ID = 1 (the first row) and update the rate
        Currency::where('id', 1)->update(
            [
                'base_currency' => $base_currency,
                'currencies' => $currencies,
                'rate' => $contentArray['data'][$currencies],
            ]
        );

        $this->comment('1 USD = IDR ' . $contentArray['data'][$currencies]);

        // Return last updated from database
        $this->comment('Last updated: ' . Currency::find(1)->updated_at);


        $this->info('Currency updated successfully!');


        // return 'Currency updated successfully!';
    }
}
