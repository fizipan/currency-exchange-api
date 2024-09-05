<?php

use App\Http\Controllers\CurrencyRateController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('fetch-midnight', function () {
    $controller = new CurrencyRateController();
    $controller->fetchFromApi();
})->purpose('Fetch data from the API at midnight')->dailyAt('00:00');
