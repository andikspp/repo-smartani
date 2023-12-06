<?php
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

// Query SQL untuk mengambil jumlah pengguna
$query = "SELECT COUNT(*) AS total_pengguna FROM users";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

// Ambil jumlah pengguna dari hasil query
$totalPengguna = $result['total_pengguna'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

      section {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        min-height: 100vh;
      }

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

      .informasi {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .informasi h2 {
            color: #004a15;
        }

        .jumlah-pengguna {
            font-size: 36px;
            color: #004a15;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <img src="Logo transparan.png" alt="Logo SmarTani" />
        <nav>
          <ul>
            <li class="menu"><a href="admin.php">Dashboard</a></li>
            <li class="menu"><a href="users.php">Pengguna</a></li>
            <li class="menu"><a href="tanaman.php">Tanaman</a></li>
            <li class="menu"><a href="kelola_harga.php">Harga Komoditas</a></li>
            <li class="menu"><a href="login.php">Logout</a></li>
          </ul>
        </nav>
      </header>

      <section>
        <h2>Selamat datang</h2>
        <div class="informasi">
          <p>Jumlah Pengguna Terdaftar: <?php echo $totalPengguna; ?></p>
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
