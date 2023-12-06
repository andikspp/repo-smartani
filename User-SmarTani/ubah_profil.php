<?php
session_start();

// Pastikan pengguna sudah login sebelum melanjutkan
if (!isset($_SESSION['user_id'])) {
    // Redirect atau lakukan sesuatu jika pengguna belum login
    header("Location: login.php");
    exit();
}

// Ambil ID pengguna dari sesi
$id = $_SESSION['user_id'];

// Informasi koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "smartani";

// Membuat koneksi
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $oldPassword = $_POST["pw"];
    $newPassword = $_POST["password"];

    // Query SQL untuk mendapatkan password lama dari database
    $query = "SELECT password FROM users WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Verifikasi password lama menggunakan password_verify
    if (password_verify($oldPassword, $user['password'])) {
        // Gunakan password_hash untuk menghash password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Query SQL untuk mengupdate password di tabel users
        $updateQuery = "UPDATE users SET password = :password WHERE id = :id";
        $updateStatement = $pdo->prepare($updateQuery);

        // Bind parameter
        $updateStatement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $updateStatement->bindParam(":id", $id, PDO::PARAM_INT);

        // Eksekusi query update
        if ($updateStatement->execute()) {
            // Password berhasil diupdate
            echo "Password berhasil diupdate.";
            // Arahkan pengguna ke halaman account.php atau halaman lain yang sesuai
            header("Location: account.php");
            exit();
        } else {
            // Terjadi kesalahan saat mengupdate password
            echo "Gagal mengupdate password.";
        }
    } else {
        // Password lama tidak cocok
        echo "Password lama tidak cocok.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profil</title>
    <style>
        /* Reset CSS */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      /* Styling Header */
      header {
        background-color: #004a15;
        color: #fff;
        text-align: center;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      header img {
        width: 50px;
        height: auto;
        padding: 10px;
      }

      header h1 {
        font-size: 24px;
      }

      header nav ul {
        list-style: none;
      }

      header nav ul li {
        display: inline;
        margin-right: 10px;
      }

      header nav ul .menu a {
        text-decoration: none;
        color: #fff;
        transition: background-color 0.3s, font-size 0.3s; /* Efek transisi saat hover */
        padding: 5px 10px; /* Padding yang diperbesar saat dihover */
        border-radius: 5px; /* Tambahkan sedikit radius sudut pada latar belakang */
      }

      header nav ul .menu a:hover {
        background-color: #00390e; /* Warna latar belakang saat hover */
        color: white; /* Warna teks saat hover */
        font-size: 26px; /* Ukuran font yang diperbesar saat hover */
        transition: background-color 0.3s, font-size 0.3s; /* Efek transisi saat hover */
      }

      #akun {
        text-decoration: none;
        color: #fff;
        transition: background-color 0.3s, font-size 0.3s; /* Efek transisi saat hover */
        padding: 5px 10px; /* Padding yang diperbesar saat dihover */
        border-radius: 5px; /* Tambahkan sedikit radius sudut pada latar belakang */
      }

      #akun:hover {
        background-color: #00390e; /* Warna latar belakang saat hover */
        color: white; /* Warna teks saat hover */
        font-size: 26px; /* Ukuran font yang diperbesar saat hover */
        transition: background-color 0.3s, font-size 0.3s; /* Efek transisi saat hover */
      }

      /* Styling Dropdown */
      .dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #004a15;
        min-width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        font-size: 12px;
      }

      .dropdown-content li a {
        text-decoration: none;
        color: #fff;
      }

      .dropdown:hover .dropdown-content {
        display: flex;
        flex-direction: column;
      }

      /* Styling Content Section */
      .content {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        min-height: 100vh;
      }


      .tentang p {
        font-size: 12px;
      }

      .tentang img {
        margin-top: 20px;
        width: 100px;
        height: auto;
      }

      /* Media Queries untuk Responsif */
      @media (max-width: 768px) {
        header {
          padding: 5px;
        }

        header h1 {
          font-size: 20px;
        }

        header nav ul {
          text-align: center;
          margin-top: 10px;
        }

        header nav ul li {
          display: block;
          margin: 5px 0;
        }

        .content {
          padding: 10px;
        }
      }

      /* Gaya footer responsif */
      .footer {
        background-color: #004a15;
        color: white;
        padding: 20px 0;
        text-align: center;
      }

      .footer-content {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .Footer-Logo img {
        width: 50px;
        height: auto;
        padding: 10px;
      }

      .footer-links {
        text-align: center;
      }

      .footer-links a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
      }

      .footer-links a:hover {
        text-decoration: underline;
      }

      /* Media query untuk responsif footer */
      @media (max-width: 768px) {
        .footer-content {
          flex-direction: column;
          align-items: center; /* Pusatkan konten footer saat di zoom out */
        }

        .Footer-Logo img {
          margin: 0; /* Hapus padding */
        }

        .footer-links {
          margin-top: 10px; /* Berikan jarak antara tautan */
          text-align: center; /* Pusatkan tautan saat di zoom out */
        }

        .footer {
          padding: 10px 0;
          position: relative;
        }
        .content {
          padding: 10px;
        }

        /* Tambahkan margin atas pada mode responsif untuk mencegah footer menutupi konten saat di-zoom in */
        .content.zoom-in {
          margin-top: 60px; /* Sesuaikan dengan tinggi footer */
        }
      }

      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        text-align: center;
      }

      h1 {
        color: #004a15;
      }

      form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      label {
        display: block;
        margin-top: 10px;
        color: #333;
      }

      input[type="text"],
      textarea,
      input[type="file"] {
        width: 80%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
      }

      input[type="submit"] {
        background-color: #004a15;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        margin-top: 20px;
      }

      input[type="submit"]:hover {
        background-color: #00390e;
      }

      input[type="file"] {
        padding: 5px;
      }

      .formulir {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        min-height: 100vh;
      }
    </style>
</head>
<body>
<header>
      <img src="Logo transparan.png" alt="Logo SmarTani" />
      <nav>
        <ul>
          <li class="menu"><a href="beranda.html">Beranda</a></li>
          <li class="menu"><a href="peta.html">Rekomendasi Tanaman</a></li>
          <li class="menu"><a href="Penjadwalan.php">Penjadwalan</a></li>
          <li class="menu"><a href="harga.php">Cek Harga Komoditas</a></li>
          <li class="menu"><a href="http://localhost:5500">Tanya AI</a></li>
          <li class="menu"><a href="account.php">Akun</a></li>
        </ul>
      </nav>
    </header>
      <section class="content">
      <div class="formulir">
      <h1>Ganti Password</h1>
  
      <form action="ubah_profil.php" method="post" enctype="multipart/form-data">
        <label for="pw">Masukkan password lama:</label>
        <input type="password" name="pw" id="pw" required>
        <br>

        <label for="password">Ganti Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        
        <input type="submit" name="submit" value="Update">
    </form>

      </div>
      </section>
  
       <footer class="footer">
        <div class="footer-content">
          <div class="Footer-Logo">
            <img src="Logo transparan.png" alt="Logo SmarTani" />
          </div>
          <div class="footer-links">
            <a href="#">Instagram</a>
            <a href="#">Facebook</a>
            <a href="#">Tiktok</a>
          </div>
        </div>
      </footer>
</body>
</html>