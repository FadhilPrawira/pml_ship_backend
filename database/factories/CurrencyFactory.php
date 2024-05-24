<?php

namespace Database\Factories;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
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

        // Get the content of the response
        $content = $response->getBody()->getContents();

        // Decode the content to an array
        $contentArray = json_decode($content, true);

        return [
            'base_currency' => 'USD',
            'currencies' => 'IDR',
            'rate' => $contentArray['data'][$currencies],
        ];
    }
}
