<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\JemuranController;

// Deprecated routes - commands are now sent directly to MQTT from the dashboard
Route::post('/jemuran/buka', [JemuranController::class, 'buka'])->name('jemuran.buka');
Route::post('/jemuran/tutup', [JemuranController::class, 'tutup'])->name('jemuran.tutup');

Route::get('/weather/{city}', [WeatherController::class, 'getWeather']);

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});