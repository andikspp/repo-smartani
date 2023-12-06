const apiKey = "29a857dd4c4b3b23e3a8df28c12dbab7";
const apiUrl = "https://api.openweathermap.org/data/2.5/weather";

// Objek untuk memetakan kode cuaca bahasa Inggris ke terjemahan bahasa Indonesia
const translations = {
  clear: "Cerah",
  clouds: "Awan",
  rain: "Hujan",
  snow: "Salju",
  haze: "Kabut",
  "light rain": "Hujan Ringan",
  "clear sky": "Cerah",
  drizzle: "Gerimis",
  thunderstorm: "Badai Petir",
  fog: "Kabut",
  mist: "Kabut Tipis",
  smoke: "Asap",
  sand: "Pasir",
  tornado: "Tornado",
  Squalls: "Angin Kencang",
  ash: "Abu Vulkanik",
  dust: "Debu",
  freezing: "Beku",
  "tropical storm": "Badai Tropis",
  hurricane: "Angin Topan",
  "broken clouds": "Berawan",
  "scattered clouds": "Awan Tersebar",
  "few clouds": "Sedikit Berawan",
  // Tambahkan lebih banyak terjemahan sesuai kebutuhan
};

const jenisTanahByLocation = {
  Depok: "Dystric Nitosols",
  Jakarta: "Dystric Nitosols",
  Bogor: "Orthic Acrisols",
};

// Fungsi untuk menerjemahkan kode cuaca dari bahasa Inggris ke bahasa Indonesia
function translateWeather(weatherCode) {
  if (translations[weatherCode]) {
    return translations[weatherCode];
  }
  return weatherCode;
}

// Fungsi untuk mengambil data cuaca dari API
async function getWeather(lat, lon) {
  try {
    const response = await fetch(
      `${apiUrl}?lat=${lat}&lon=${lon}&appid=${apiKey}`
    );
    const data = await response.json();

    // Ubah suhu dari Kelvin ke Celsius dan hilangkan desimal
    const celsius = Math.round(data.main.temp - 273.15);

    // Mengganti teks cuaca dengan terjemahan dalam bahasa Indonesia
    const locationElement = document.getElementById("location");
    if (locationElement) {
      locationElement.textContent = `Lokasi: ${data.name}`;
    }
    const temperatureElement = document.getElementById("temperature");
    if (temperatureElement) {
      temperatureElement.textContent = `Suhu: ${celsius} °C`;
    }
    const weatherDescription = data.weather[0].description;
    const descriptionElement = document.getElementById("description");
    if (descriptionElement) {
      descriptionElement.textContent = `Cuaca: ${translateWeather(
        weatherDescription
      )}`;
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// Ambil lokasi pengguna
navigator.geolocation.getCurrentPosition(
  function (position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    // Panggil fungsi getWeather dengan koordinat pengguna
    getWeather(lat, lon);

    fetch(
      `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`
    )
      .then((response) => response.json())
      .then((data) => {
        const city = data.address.city;
        console.log(jenisTanahByLocation[city]); // Periksa data jenis tanah sebelum mengirim
        if (jenisTanahByLocation[city]) {
          // jenis tanah berdasarkan lokasi pengguna
          const jenisTanahElement = document.getElementById("jenisTanah");
          if (jenisTanahElement) {
            jenisTanahElement.textContent = `Jenis Tanah: ${jenisTanahByLocation[city]}`;
          }
          console.log(jenisTanahByLocation[city]);
          // Setelah mendapatkan jenis tanah, kirim ke server PHP
          sendJenisTanahToServer(jenisTanahByLocation[city]);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  },
  function (error) {
    console.error("Error getting geolocation:", error);
  }
);

async function sendJenisTanahToServer(jenisTanah) {
  console.log(jenisTanah);
  try {
    const response = await fetch("/smartani/ambil_tanaman.php", {
      method: "POST",
      body: JSON.stringify({ jenisTanah }),
      headers: {
        "Content-Type": "application/json",
      },
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
  } catch (error) {
    console.error("Error:", error);
  }
}
