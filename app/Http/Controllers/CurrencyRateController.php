<?php

namespace App\Http\Controllers;

use App\Http\Resources\Currency\CurrencyRateResource;
use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyRateController extends Controller
{
    // Display the cached currency exchange rates
    public function index()
    {
        $currencyRates = CurrencyRate::all();
        return CurrencyRateResource::collection($currencyRates);
    }

    // Refresh and return updated rates
    public function refresh()
    {
        $this->fetchFromApi();
        $currencyRates = CurrencyRate::all();
        return CurrencyRateResource::collection($currencyRates);
    }

    // Method to fetch the currency rates from the API and store them in the database
    public function fetchFromApi()
    {
        $response = Http::get('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json');

        if ($response->successful()) {
            $data = $response->json();

            foreach ($data['usd'] as $currency => $rate) {
                CurrencyRate::updateOrCreate(
                    ['currency' => $currency],
                    ['rate' => $rate]
                );
            }
        } else {
            return response()->json(['message' => 'Failed to fetch currency rates.'], 500);
        }
    }
}
