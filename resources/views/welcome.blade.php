<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Smart Clothesline – Dashboard</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}" />
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="brand">
            <div class="logo">SC</div>
            <div>
                <h1>Smart Clothesline</h1>
                <p>Sistem Jemuran Pintar</p>
            </div>
        </div>
        <div class="header-actions">
            <div class="online">
                <span class="dot"></span>
                <span>Terhubung</span>
            </div>
            <button class="icon-btn" aria-label="Notifikasi">🔔</button>
            <button class="icon-btn" aria-label="Pengaturan">⚙️</button>
        </div>
    </header>

    <main class="container">
        <section class="intro mb-10">
            <h2>Dashboard Smart Clothesline</h2>
            <p>Kelola sistem jemuran pintar Anda dengan mudah dan efisien</p>
        </section>

        <!-- Top grid: Cuaca, Efisiensi, Kontrol Cepat -->
        <section class="grid grid-3 mb">

            <!-- MAP Card -->
            <article class="card">
                <div class="card-header">
                    <h3>Peta Lokasi</h3>
                    <span class="badge badge-eco">📍 Live Position</span>
                </div>
                <div class="card-content space">
                    <div id="map" style="height: 300px; border-radius: 12px; overflow: hidden;"></div>
                    <p class="muted small mt">
                        🗺️ Peta ini menampilkan posisi jemuran pintar Anda secara real-time menggunakan layanan OpenStreetMap.
                        Pastikan izin lokasi diaktifkan agar posisi dapat terdeteksi dengan tepat.
                    </p>
                </div>
            </article>

            <!-- Tambahkan Leaflet CSS & JS -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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

            <!-- Weather Card -->
            <article class="card">
                <div class="card-header">
                    <h3>Kondisi Cuaca</h3>
                    <span class="badge badge-ok">Optimal</span>
                </div>
                <div class="card-content space">
                    <!-- Lokasi -->
                    <div class="flex items-center gap-2 muted text-sm mb-2">
                        <span class="text-lg">📍</span>
                        <span id="weather-location">Bandung, Indonesia</span>
                    </div>

                    <div class="weather-icon" aria-hidden="true">☀️</div>

                    <div class="stats grid-2">
                        <div class="stat">
                            <div class="stat-icon">🌡️</div>
                            <div>
                                <p class="muted">Suhu</p>
                                <p class="value">28°C</p>
                            </div>
                        </div>
                        <div class="stat">
                            <div class="stat-icon">💧</div>
                            <div>
                                <p class="muted">Kelembaban</p>
                                <p class="value">65%</p>
                            </div>
                        </div>
                        <div class="stat">
                            <div class="stat-icon">🌬️</div>
                            <div>
                                <p class="muted">Angin</p>
                                <p class="value">12 km/h</p>
                            </div>
                        </div>
                        <div class="stat">
                            <div class="stat-icon">🌧️</div>
                            <div>
                                <p class="muted">Hujan</p>
                                <p class="value">0%</p>
                            </div>
                        </div>
                    </div>

                    <div class="note note-ok">✓ Kondisi sangat baik untuk menjemur pakaian</div>
                </div>
            </article>

            <!-- Quick Actions -->
            <article class="card">
                <div class="card-header">
                    <h3>Kontrol Cepat</h3>
                </div>
                <div class="card-content">
                    <div class="grid grid-2 gap">
                        <button id="btn-on" class="btn btn-outline action">
                            <span class="ico">⏻</span>
                            <span>Nyalakan Semua</span>
                        </button>

                        <button id="btn-reset" class="btn btn-outline action">
                            <span class="ico">↺</span>
                            <span>Reset Semua</span>
                        </button>

                        <button id="btn-bentang" class="btn btn-outline action">
                            <span class="ico">⬌</span>
                            <span>Bentangkan</span>
                        </button>

                        <button id="btn-lipat" class="btn btn-outline action">
                            <span class="ico">⬍</span>
                            <span>Lipat/Tarik</span>
                        </button>

                        <button id="mode-day" class="btn btn-outline action"><span class="ico">🌞</span><span>Mode Siang</span></button>
                        <button id="mode-night" class="btn btn-outline action"><span class="ico">🌙</span><span>Mode Malam</span></button>
                    </div>
                    <div class="note note-warn mt">
                        💡 Tip: Gunakan mode otomatis untuk efisiensi terbaik
                    </div>
                </div>
            </article>

            <!-- Script toggle -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const body = document.body;
                    const dayBtn = document.getElementById("mode-day");
                    const nightBtn = document.getElementById("mode-night");

                    dayBtn.addEventListener("click", () => {
                        body.classList.remove("dark-mode");
                    });

                    nightBtn.addEventListener("click", () => {
                        body.classList.add("dark-mode");
                    });
                });
            </script>
        </section>

        <!-- Middle row -->
        <section class="grid grid-3 mb">
            <!-- Clothesline Status -->
            <article class="card grid-span-2">
                <div class="card-header">
                    <h3>Status Jemuran</h3>
                </div>
                <div class="card-content">
                    <div class="grid grid-3 gap">
                        <div class="tile">
                            <div class="tile-title">Posisi Rel</div>
                            <div class="tile-value" id="rel-value">Terbuka 82%</div>
                            <div class="progress"><span id="rel-progress" style="width:82%"></span></div>
                        </div>
                        <div class="tile">
                            <div class="tile-title">Sensor Hujan</div>
                            <div class="tile-value ok">Kering</div>
                            <p class="muted small">Tidak ada tetesan terdeteksi</p>
                        </div>
                        <div class="tile">
                            <div class="tile-title">Siklus</div>
                            <div class="tile-value">28 selesai</div>
                            <p class="muted small">Minggu ini</p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Catatan -->
            <article class="card">
                <div class="card-header">
                    <h3>Catatan</h3>
                </div>
                <div class="card-content">
                    <textarea id="notes" placeholder="Tulis catatan di sini..."
                        class="w-full p-3 border rounded-md mb-3 text-sm leading-normal tile-value"
                        rows="6"></textarea>
                    <button id="save-notes"
                        class="btn btn-outline w-full tile">
                        💾 Simpan Catatan
                    </button>
                </div>
            </article>
        </section>

        <!-- Settings -->
        <section class="grid grid-3">
            <!-- Smart Settings -->
            <article class="card grid-span-2">
                <div class="card-header">
                    <h3>Pengaturan Pintar</h3>
                </div>
                <div class="card-content">
                    <div class="grid grid-2 gap">
                        <div>
                            <h4 class="section-sub">📱 Notifikasi</h4>
                            <div class="list">
                                <label class="switch-row">
                                    <span>Peringatan Cuaca</span>
                                    <input type="checkbox" class="switch-input" checked>
                                    <span class="slider"></span>
                                </label>
                                <label class="switch-row">
                                    <span>Notifikasi Selesai</span>
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                                <label class="switch-row">
                                    <span>Peringatan Hujan</span>
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <h4 class="section-sub">⏱️ Pengaturan Timer</h4>
                            <div class="form-group">
                                <label for="jenis-kain">Jenis Kain Default</label>
                                <div class="select">
                                    <select id="jenis-kain">
                                        <option>Pilih jenis kain</option>
                                        <option>Katun (2-3 jam)</option>
                                        <option>Polyester (1-2 jam)</option>
                                        <option>Denim (3-4 jam)</option>
                                        <option>Sutra (30-45 menit)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mode">Mode Pengeringan</label>
                                <div class="select">
                                    <select id="mode">
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

                    <div class="divider"></div>

                    <h4 class="section-sub">🛡️ Keamanan & Privasi</h4>
                    <div class="grid grid-2 gap">
                        <label class="switch-row">
                            <span>Tarik Otomatis saat Hujan</span>
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <label class="switch-row">
                            <span>Mode Malam Otomatis</span>
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </article>

            <!-- Sidebar statistics -->
            <article class="card">
                <div class="card-header">
                    <h3>Statistik Mingguan</h3>
                </div>
                <div class="card-content list">
                    <div class="row"><span class="muted">Total Waktu Aktif</span><strong>42h 15m</strong></div>
                    <div class="row"><span class="muted">Siklus Selesai</span><strong>28 siklus</strong></div>
                    <div class="row"><span class="muted">Efisiensi Rata-rata</span><strong class="ok">91%</strong></div>
                    <div class="row"><span class="muted">Penghematan Bulanan</span><strong class="ok">Rp 186.000</strong></div>
                </div>
            </article>
        </section>

        <footer class="footer">
            Smart Clothesline System v2.1 • Hemat energi, ramah lingkungan
        </footer>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const btnOn = document.getElementById("btn-on");
            const btnReset = document.getElementById("btn-reset");
            const btnBentang = document.getElementById("btn-bentang");
            const btnLipat = document.getElementById("btn-lipat");

            const relValue = document.getElementById("rel-value");
            const relProgress = document.getElementById("rel-progress");
            const switches = document.querySelectorAll(".switch-input");

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

                    tempEl.textContent = `${Math.round(dataWeather.main.temp)}°C`;
                    humidityEl.textContent = `${dataWeather.main.humidity}%`;
                    windEl.textContent = `${dataWeather.wind.speed} m/s`;
                    rainEl.textContent = dataWeather.rain ? `${dataWeather.rain["1h"]} mm` : "0%";

                    const condition = dataWeather.weather[0].main.toLowerCase();
                    if (condition.includes("cloud")) {
                        weatherIcon.textContent = "☁️";
                    } else if (condition.includes("rain")) {
                        weatherIcon.textContent = "🌧️";
                    } else if (condition.includes("clear")) {
                        weatherIcon.textContent = "☀️";
                    } else if (condition.includes("snow")) {
                        weatherIcon.textContent = "❄️";
                    } else {
                        weatherIcon.textContent = "🌤️";
                    }
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
                            updateWeather(latitude, longitude);
                            // refresh tiap 10 menit
                            setInterval(() => updateWeather(latitude, longitude), 600000);
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

</body>

</html>