<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Clothesline</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-indigo-600">Smart Clothesline System</h1>
            </div>
        </header>
        
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <div class="text-center">
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Welcome to Smart Clothesline</h1>
                        <p class="text-xl text-gray-600 mb-10">Intelligent clothesline management with weather integration</p>
                        
                        @auth
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg max-w-3xl mx-auto mb-10">
                                <div class="px-4 py-5 sm:p-6">
                                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Welcome back, {{ Auth::user()->name }}!</h2>
                                    <p class="text-gray-600 mb-6">You're already signed in to your account.</p>
                                    <div class="flex justify-center">
                                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Go to Dashboard
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg max-w-3xl mx-auto">
                                <div class="px-4 py-5 sm:p-6">
                                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Get Started</h2>
                                    <p class="text-gray-600 mb-8">Sign in to your account or create a new one to access your smart clothesline dashboard.</p>
                                    
                                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                                        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Sign In
                                        </a>
                                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Create Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        
                        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                            <div class="bg-white p-6 rounded-lg shadow">
                                <div class="text-indigo-600 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Weather Integration</h3>
                                <p class="text-gray-600">Automatic clothesline control based on real-time weather data</p>
                            </div>
                            
                            <div class="bg-white p-6 rounded-lg shadow">
                                <div class="text-indigo-600 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Smart Analytics</h3>
                                <p class="text-gray-600">Track usage patterns and optimize drying efficiency</p>
                            </div>
                            
                            <div class="bg-white p-6 rounded-lg shadow">
                                <div class="text-indigo-600 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Smart Notifications</h3>
                                <p class="text-gray-600">Receive alerts for optimal drying conditions and system status</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="bg-white mt-12">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-500 text-sm">
                    &copy; 2025 Smart Clothesline System. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
    
    @vite('resources/js/app.js')
</body>
</html>