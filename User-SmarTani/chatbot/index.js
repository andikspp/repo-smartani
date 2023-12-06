// Import modul Dotenv dan konfigurasinya
require("dotenv").config();

// Impor modul-modul lain yang Anda butuhkan
const express = require("express");
const openai = require("openai");

// Konfigurasi variabel lingkungan
const apiKey = process.env.OPENAI_API_KEY;

// Mengatur kunci API OpenAI
openai.apiKey = apiKey;

// Inisialisasi aplikasi Express
const app = express();
const port = 3000;

// Middleware untuk menguraikan data JSON
app.use(express.json());

// Menyediakan file statis seperti CSS atau gambar (jika ada)
app.use(express.static(__dirname));

// Rute GET untuk halaman antarmuka pengguna
app.get("/", (req, res) => {
  // Mengirimkan file HTML sebagai halaman utama
  res.sendFile(__dirname + "/ai.html");
});

// Rute POST untuk permintaan ke layanan AI
app.post("/ask-ai", async (req, res) => {
  const userMessage = req.body.message;

  try {
    const prompt = userMessage;
    const maxTokens = 100;

    const { choices } = await openai.completions.create({
      engine: "davinci-codex",
      prompt,
      max_tokens: maxTokens,
    });

    if (choices && choices.length > 0) {
      const aiResponse = choices[0].text;
      res.json({ aiResponse });
    } else {
      console.error("Respons AI tidak valid.");
      res.status(500).json({ error: "Terjadi kesalahan" });
    }
  } catch (error) {
    console.error("Terjadi kesalahan dalam permintaan ke layanan AI: " + error);
    res.status(500).json({ error: "Terjadi kesalahan" });
  }
});

// Menjalankan server
app.listen(port, () => {
  console.log(`Server berjalan pada port ${port}`);
});
