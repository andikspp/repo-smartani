// app.js

const express = require("express");
const dotenv = require("dotenv");
const OpenAI = require("openai");
const path = require('path');

dotenv.config(); // Menggunakan konfigurasi dari berkas .env

const app = express();
const port = process.env.PORT || 5500;

// Mengatur kunci API OpenAI
const openai = new OpenAI({ key: process.env.OPENAI_API_KEY });

app.use(express.json());

app.use(express.static('C:/xampp/htdocs/smartani'));
app.use(express.static('C:/xampp/htdocs/smartani/User-SmarTani'));
app.use(express.static('C:/xampp/htdocs/smartani/User-SmarTani/chatbot'));

// Mengirimkan berkas HTML sebagai halaman utama
app.get("/", (req, res) => {
  res.sendFile(__dirname + "/ai2.html");
});

app.post("/ask-ai", async (req, res) => {
  const userMessage = req.body.message;

  try {
    const prompt = userMessage;
    const maxTokens = 100;

    const { choices } = await openai.chat.completions.create({
      model: "gpt-3.5-turbo",
      messages: [
        { role: "system", content: "You are a helpful assistant." },
        { role: "user", content: prompt },
      ],
      max_tokens: maxTokens,
    });

    if (choices && choices.length > 0) {
      const aiResponse = choices[0].message.content;
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

app.listen(port, () => {
  console.log(`Server berjalan pada port ${port}`);
});
