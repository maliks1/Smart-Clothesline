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
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold text-indigo-600">Smart Clothesline</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 hidden md:inline">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-900">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Welcome Message -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold mb-4">Welcome to your Smart Clothesline Dashboard</h2>
                <p class="text-gray-600">You are successfully logged in as {{ Auth::user()->email }}</p>
                
                <div class="mt-8">
                    <h3 class="text-xl font-medium mb-4">System Status</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                            <h4 class="font-medium text-lg mb-2">Clothesline Status</h4>
                            <p class="text-green-500 font-semibold">Operational</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                            <h4 class="font-medium text-lg mb-2">Weather Conditions</h4>
                            <p class="text-blue-500 font-semibold">Sunny</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                            <h4 class="font-medium text-lg mb-2">Next Scheduled Task</h4>
                            <p class="text-purple-500 font-semibold">Retract in 2 hours</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="container mx-auto">
                <section class="intro mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Smart Clothesline</h2>
                    <p class="text-gray-600">Kelola sistem jemuran pintar Anda dengan mudah dan efisien</p>
                </section>

                <!-- Top grid: Cuaca, Efisiensi, Kontrol Cepat -->
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- MAP Card -->
                    <article class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Peta Lokasi</h3>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">📍 Live Position</span>
                        </div>
                        <div class="p-6 space-y-4">
                            <div id="map" style="height: 300px; border-radius: 12px; overflow: hidden;"></div>
                            <p class="text-gray-500 text-sm">
                                🗺️ Peta ini menampilkan posisi jemuran pintar Anda secara real-time menggunakan layanan
                                OpenStreetMap.
                                Pastikan izin lokasi diaktifkan agar posisi dapat terdeteksi dengan tepat.
                            </p>
                        </div>
                    </article>

                    <!-- Weather Card -->
                    <article class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Kondisi Cuaca</h3>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Optimal</span>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Lokasi -->
                            <div class="flex items-center gap-2 text-gray-500 text-sm">
                                <span class="text-lg">📍</span>
                                <span id="weather-location">Bandung, Indonesia</span>
                            </div>

                            <div class="text-5xl text-center text-yellow-500" aria-hidden="true">☀️</div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="text-2xl">🌡️</div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Suhu</p>
                                        <p class="font-bold text-lg">28°C</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="text-2xl">💧</div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Kelembaban</p>
                                        <p class="font-bold text-lg">65%</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="text-2xl">🌬️</div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Angin</p>
                                        <p class="font-bold text-lg">12 km/h</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="text-2xl">🌧️</div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Hujan</p>
                                        <p class="font-bold text-lg">0%</p>
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
                                <button id="btn-on" class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50">
                                    <span class="text-2xl mb-2">⏻</span>
                                    <span class="text-sm">Nyalakan Semua</span>
                                </button>

                                <button id="btn-reset" class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50">
                                    <span class="text-2xl mb-2">↺</span>
                                    <span class="text-sm">Reset Semua</span>
                                </button>

                                <button id="btn-bentang" class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50">
                                    <span class="text-2xl mb-2">⬌</span>
                                    <span class="text-sm">Bentangkan</span>
                                </button>

                                <button id="btn-lipat" class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50">
                                    <span class="text-2xl mb-2">⬍</span>
                                    <span class="text-sm">Lipat/Tarik</span>
                                </button>

                                <button id="mode-day" class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50">
                                    <span class="text-2xl mb-2">🌞</span>
                                    <span class="text-sm">Mode Siang</span>
                                </button>
                                <button id="mode-night" class="border border-gray-300 rounded-lg p-4 flex flex-col items-center hover:bg-gray-50">
                                    <span class="text-2xl mb-2">🌙</span>
                                    <span class="text-sm">Mode Malam</span>
                                </button>
                            </div>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-yellow-800 text-sm mt-4">
                                💡 Tip: Gunakan mode otomatis untuk efisiensi terbaik
                            </div>
                        </div>
                    </article>
                </section>

                <!-- Middle row -->
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Clothesline Status -->
                    <article class="bg-white rounded-lg shadow border border-gray-200 lg:col-span-2">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">Status Jemuran</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="text-gray-500 text-sm mb-1">Posisi Rel</div>
                                    <div class="font-bold text-lg mb-2" id="rel-value">Terbuka 82%</div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div id="rel-progress" class="bg-blue-600 h-2 rounded-full" style="width:82%"></div>
                                    </div>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="text-gray-500 text-sm mb-1">Sensor Hujan</div>
                                    <div class="font-bold text-green-500 text-lg mb-1">Kering</div>
                                    <p class="text-gray-500 text-sm">Tidak ada tetesan terdeteksi</p>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="text-gray-500 text-sm mb-1">Siklus</div>
                                    <div class="font-bold text-lg mb-1">28 selesai</div>
                                    <p class="text-gray-500 text-sm">Minggu ini</p>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Catatan -->
                    <article class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">Catatan</h3>
                        </div>
                        <div class="p-6">
                            <textarea id="notes" placeholder="Tulis catatan di sini..."
                                class="w-full p-3 border border-gray-300 rounded-md mb-3 text-sm leading-normal" rows="6"></textarea>
                            <button id="save-notes" class="w-full border border-gray-300 rounded-lg p-3 text-center hover:bg-gray-50">
                                💾 Simpan Catatan
                            </button>
                        </div>
                    </article>
                </section>

                <!-- Settings -->
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Smart Settings -->
                    <article class="bg-white rounded-lg shadow border border-gray-200 lg:col-span-2">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">Pengaturan Pintar</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-3">📱 Notifikasi</h4>
                                    <div class="space-y-3">
                                        <label class="flex items-center justify-between">
                                            <span>Peringatan Cuaca</span>
                                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <span>Notifikasi Selesai</span>
                                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <span>Peringatan Hujan</span>
                                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-medium text-gray-900 mb-3">⏱️ Pengaturan Timer</h4>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm text-gray-700 mb-1">Jenis Kain Default</label>
                                            <select class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                                                <option>Pilih jenis kain</option>
                                                <option>Katun (2-3 jam)</option>
                                                <option>Polyester (1-2 jam)</option>
                                                <option>Denim (3-4 jam)</option>
                                                <option>Sutra (30-45 menit)</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm text-gray-700 mb-1">Mode Pengeringan</label>
                                            <select class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                                                <option>Pilih mode</option>
                                                <option>Normal</option>
                                                <option>Eco (Hemat Energi)</option>
                                                <option>Cepat</option>
                                                <option>Lembut</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 my-6"></div>

                            <h4 class="font-medium text-gray-900 mb-3">🛡️ Keamanan & Privasi</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <label class="flex items-center justify-between">
                                    <span>Tarik Otomatis saat Hujan</span>
                                    <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                </label>
                                <label class="flex items-center justify-between">
                                    <span>Mode Malam Otomatis</span>
                                    <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                </label>
                            </div>
                        </div>
                    </article>

                    <!-- Sidebar statistics -->
                    <article class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">Statistik Mingguan</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Waktu Aktif</span>
                                    <strong>42h 15m</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Siklus Selesai</span>
                                    <strong>28 siklus</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Efisiensi Rata-rata</span>
                                    <strong class="text-green-500">91%</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Penghematan Bulanan</span>
                                    <strong class="text-green-500">Rp 186.000</strong>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>

                <footer class="text-center text-gray-500 text-sm mt-12 py-6">
                    Smart Clothesline System v2.1 • Hemat energi, ramah lingkungan
                </footer>
            </div>
        </div>
    </main>
    
    @vite('resources/js/app.js')
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const btnOn = document.getElementById("btn-on");
            const btnReset = document.getElementById("btn-reset");
            const btnBentang = document.getElementById("btn-bentang");
            const btnLipat = document.getElementById("btn-lipat");

            const relValue = document.getElementById("rel-value");
            const relProgress = document.getElementById("rel-progress");
            const switches = document.querySelectorAll("input[type='checkbox']");

            // Fungsi nyalakan semua
            btnOn.addEventListener("click", () => {
                switches.forEach(sw => sw.checked = true);
                relValue.textContent = "Terbuka 100%";
                relProgress.style.width = "100%";
                alert("✅ Semua fungsi dinyalakan");
            });

            // Fungsi reset semua
            btnReset.addEventListener("click", () => {
                switches.forEach(sw => sw.checked = false);
                relValue.textContent = "Tertutup 0%";
                relProgress.style.width = "0%";
                alert("🔄 Semua fungsi direset");
            });

            // Fungsi bentangkan (set ke 100%)
            btnBentang.addEventListener("click", () => {
                relValue.textContent = "Terbuka 100%";
                relProgress.style.width = "100%";
                alert("⬌ Jemuran dibentangkan");
            });

            // Fungsi lipat/tarik (set ke 0%)
            btnLipat.addEventListener("click", () => {
                relValue.textContent = "Tertutup 0%";
                relProgress.style.width = "0%";
                alert("⬍ Jemuran ditarik / dilipat");
            });

            // ===== Catatan =====
            const notesArea = document.getElementById("notes");
            const saveBtn = document.getElementById("save-notes");

            if (localStorage.getItem("dashboardNotes")) {
                notesArea.value = localStorage.getItem("dashboardNotes");
            }

            saveBtn.addEventListener("click", () => {
                localStorage.setItem("dashboardNotes", notesArea.value);
                alert("📝 Catatan berhasil disimpan!");
            });

            // ===== Lokasi + Cuaca =====
            const locationSpan = document.getElementById("weather-location");
            const tempEl = document.querySelectorAll(".stat .value")[0]; // suhu
            const humidityEl = document.querySelectorAll(".stat .value")[1]; // kelembaban
            const windEl = document.querySelectorAll(".stat .value")[2]; // angin
            const rainEl = document.querySelectorAll(".stat .value")[3]; // hujan
            const weatherIcon = document.querySelector(".weather-icon");

            const API_KEY = "YOUR_API_KEY"; // ganti dengan API key OpenWeather

            async function updateWeather(lat, lon) {
                try {
                    // Lokasi text
                    const resLoc = await fetch(
                        `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`
                    );
                    const dataLoc = await resLoc.json();
                    const city = dataLoc.address.city ||
                        dataLoc.address.town ||
                        dataLoc.address.village ||
                        dataLoc.address.county ||
                        "Lokasi tidak diketahui";
                    const country = dataLoc.address.country || "";
                    locationSpan.textContent = `${city}, ${country}`;

                    // Cuaca real-time
                    const resWeather = await fetch(
                        `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${API_KEY}&units=metric&lang=id`
                    );
                    const dataWeather = await resWeather.json();

                    // Update UI elements with weather data
                    // (This would need to be adapted based on actual DOM structure)
                } catch (err) {
                    locationSpan.textContent = "Gagal memuat cuaca";
                }
            }

            if (locationSpan) {
                locationSpan.textContent = "Mendeteksi lokasi...";

                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(
                        (pos) => {
                            const {
                                latitude,
                                longitude
                            } = pos.coords;
                            // updateWeather(latitude, longitude);
                            // refresh tiap 10 menit
                            // setInterval(() => updateWeather(latitude, longitude), 600000);
                        },
                        () => {
                            locationSpan.textContent = "Izin lokasi ditolak";
                        }
                    );
                } else {
                    locationSpan.textContent = "Browser tidak mendukung geolokasi";
                }
            }

            // ===== Mode malam otomatis =====
            const body = document.body;
            const autoNightSwitch = document.querySelector(
                'label.switch-row:has(span:contains("Mode Malam Otomatis")) input'
            );

            function checkAutoNight() {
                if (autoNightSwitch && autoNightSwitch.checked) {
                    const hour = new Date().getHours();
                    if (hour >= 18 || hour < 6) {
                        body.classList.add("dark-mode"); // malam
                    } else {
                        body.classList.remove("dark-mode"); // siang
                    }
                }
            }

            checkAutoNight();
            setInterval(checkAutoNight, 300000); // cek ulang tiap 5 menit
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