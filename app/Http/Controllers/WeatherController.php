<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($city)
    {
        $apiKey = config('services.openweather.key');

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q'     => $city,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang'  => 'id',
        ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gagal mengambil data cuaca'
            ], 500);
        }

        return $response->json();
    }
}
