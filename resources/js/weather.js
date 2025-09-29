document.addEventListener("DOMContentLoaded", function() {
    const city = "Bandung";
    const url = `/weather/${city}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById("weather-location").textContent = data.error;
                return;
            }

            document.getElementById("weather-location").textContent = data.name;
            document.getElementById("weather-temp").textContent = data.main.temp;
            document.getElementById("weather-hum").textContent = data.main.humidity;
            document.getElementById("weather-wind").textContent = data.wind.speed;
            document.getElementById("weather-icon").src =
                `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
                document.getElementById("weather-pop").textContent = "10";

        })
        .catch(error => {
            console.error("Gagal memuat data cuaca:", error);
            document.getElementById("weather-location").textContent = "Gagal memuat";
        });
});
