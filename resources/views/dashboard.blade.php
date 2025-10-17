<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Clothesline | Dashboard</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    @vite('resources/css/app.css')

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold text-indigo-600">Dashboard Smart Clothesline</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 hidden md:inline">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-900">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="">
        <!-- Dashboard Content -->
        <div class="p-6">
            <!-- Top grid: Cuaca, Efisiensi, Kontrol Cepat -->
            <section class="grid lg:grid-cols-4 gap-6 mb-8">
                <!-- MAP Card -->
                <article class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Peta Lokasi</h3>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">📍
                            Live Position</span>
                    </div>
                    <div class="p-6 space-y-4">
                        <div id="map" class="h-[300px] rounded-xl overflow-hidden mt-4"></div>
                        <p class="text-gray-500 text-sm">
                            🗺️ Peta ini menampilkan posisi jemuran pintar Anda secara real-time.
                        </p>
                    </div>
                </article>

                <!-- Weather Card -->
                <article class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Kondisi Cuaca</h3>
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Optimal</span>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Lokasi -->
                        <div class="flex items-center gap-2 text-gray-500 text-sm">
                            <span class="text-lg">📍</span>
                            <span id="weather-location">Memuat...</span>
                        </div>

                        <div class="text-5xl text-center">
                            <img id="weather-icon" alt="" class="inline-block w-16 h-16" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-3">
                                <div class="text-2xl">🌡️</div>
                                <div>
                                    <p class="text-gray-500 text-sm">Suhu</p>
                                    <p class="font-bold text-lg"><span id="weather-temp">—</span>°C</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="text-2xl">💧</div>
                                <div>
                                    <p class="text-gray-500 text-sm">Kelembaban</p>
                                    <p class="font-bold text-lg"><span id="weather-hum">—</span>%</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="text-2xl">🌬️</div>
                                <div>
                                    <p class="text-gray-500 text-sm">Angin</p>
                                    <p class="font-bold text-lg"><span id="weather-wind">—</span> km/h</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="text-2xl">🌧️</div>
                                <div>
                                    <p class="text-gray-500 text-sm">Peluang Hujan (hari ini)</p>
                                    <p class="font-bold text-lg"><span id="weather-pop">—</span>%</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-green-800 text-sm">
                            ✓ Kondisi sangat baik untuk menjemur pakaian.
                        </div>
                    </div>
                </article>

                <!-- Quick Actions -->
                <article class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Kontrol Cepat</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <button id="btn-bentang"
                                class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50 transition-colors">
                                <span class="text-2xl mb-2">⬌</span>
                                <span class="text-sm">Bentangkan</span>
                            </button>

                            <button id="btn-lipat"
                                class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50 transition-colors">
                                <span class="text-2xl mb-2">⬍</span>
                                <span class="text-sm">Lipat</span>
                            </button>
                        </div>
                        <div class="px-6 py-4 border-b border-gray-200 mt-16">
                            <h3 class="text-lg font-semibold">Statistik Mingguan</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Waktu Aktif</span>
                                    <strong>32h 10m</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Siklus Selesai</span>
                                    <strong>8 siklus</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Efisiensi Rata-rata</span>
                                    <strong class="text-green-500">91%</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Status Jemuran</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="text-gray-500 text-sm mb-1">Posisi Rel</div>
                                <div class="font-bold text-lg mb-2" id="rel-value">Terbuka 100%</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div id="rel-progress" class="bg-blue-600 h-2 rounded-full w-full"
                                        style="width:100%">
                                    </div>
                                </div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="text-gray-500 text-sm mb-1">Sensor Hujan</div>
                                <div class="font-bold text-green-500 text-lg mb-1">Kering</div>
                                <p class="text-gray-500 text-sm">Tidak ada tetesan terdeteksi</p>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="text-gray-500 text-sm mb-1">Siklus</div>
                                <div class="font-bold text-lg mb-1">1 selesai</div>
                                <p class="text-gray-500 text-sm">hari ini</p>
                            </div>
                        </div>
                    </div>
                </article>
            </section>

            <footer class="text-center text-gray-500 text-sm">
                Smart Clothesline System v1.0 • Hemat energi, ramah lingkungan
            </footer>
        </div>
    </main>

    @vite('resources/js/app.js')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const btnBentang = document.getElementById("btn-bentang");
            const btnLipat = document.getElementById("btn-lipat");
            const relValue = document.getElementById("rel-value");
            const relProgress = document.getElementById("rel-progress");

            // Fungsi bentangkan (set ke 100%)
            // Fungsi helper POST
            function sendCommand(url) {
                fetch(url, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({})
                }).then(res => {
                    if (!res.ok) throw new Error("Gagal kirim command");
                    return res.text();
                }).then(() => {
                    console.log("Command terkirim ke " + url);
                }).catch(err => {
                    console.error(err);
                    alert("Gagal kirim perintah ke server!");
                });
            }

            btnBentang.addEventListener("click", () => {
                relValue.textContent = "Terbuka 100%";
                relProgress.style.width = "100%";
                sendCommand("{{ route('jemuran.buka') }}");
            });

            btnLipat.addEventListener("click", () => {
                relValue.textContent = "Tertutup 0%";
                relProgress.style.width = "0%";
                sendCommand("{{ route('jemuran.tutup') }}");
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Inisialisasi peta
            const map = L.map('map').setView([-6.914744, 107.609810], 13); // default Bandung

            // Tambahkan tile layer dari OSM
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Marker default
            const marker = L.marker([-6.914744, 107.609810]).addTo(map)
                .bindPopup("Lokasi awal (Bandung)").openPopup();

            // Update sesuai lokasi user
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const {
                            latitude,
                            longitude
                        } = pos.coords;
                        map.setView([latitude, longitude], 15);
                        marker.setLatLng([latitude, longitude])
                            .bindPopup("📍 Lokasi Anda").openPopup();
                    },
                    () => {
                        console.warn("Izin lokasi ditolak, gunakan default Bandung");
                    }
                );
            }
        });
    </script>
</body>

</html>