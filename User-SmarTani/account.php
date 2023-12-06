<?php
// Mulai sesi
session_start();

// Gantilah informasi koneksi database sesuai dengan konfigurasi Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartani";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data pengguna dari tabel users berdasarkan informasi sesi
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  // Menggunakan parameterized query untuk mencegah SQL injection
  $sql = "SELECT u.username, u.email, p.profile_picture FROM users u LEFT JOIN user_profiles p ON u.id = p.user_id WHERE u.id = ?";
  $statement = $conn->prepare($sql);
  $statement->bind_param("i", $user_id);
  $statement->execute();
  $result = $statement->get_result();

  if ($result->num_rows > 0) {
      // Output data dari setiap baris
      while ($row = $result->fetch_assoc()) {
          $username = $row['username'];
          $email_pengguna = $row['email'];
          $profile_picture = "foto_profile/" . $row['profile_picture']; // Sesuaikan dengan path direktori gambar Anda
      }
  } else {
      echo "Data pengguna tidak ditemukan";
  }


    $statement->close(); // Menutup statement
} else {
    // Jika sesi tidak ditemukan, redirect atau tampilkan pesan sesuai kebijakan aplikasi Anda
    header("Location: login.php"); // Gantilah dengan halaman login Anda
    exit();
}

// Menutup koneksi database
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Pengguna</title>
    <style>
      /* Reset CSS */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
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

      .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        min-height: 100vh;
        text-align: center;
      }

      .profile-picture {
        display: flex;
        justify-content: center;
      }

      .profile-picture img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid #333;
      }

      .user-details {
        text-align: center;
      }

      .user-details h2 {
        font-size: 24px;
        margin: 10px 0;
      }

      .user-details p {
        font-size: 18px;
        margin: 5px 0;
        text-align: center;
      }

      .user-details a {
        text-decoration: none;
        color: #007bff;
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
      }

      button {
        background-color: #004a15;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        margin-top: 200px;
      }

      button:hover {
        background-color: #00390e;
      }

      .exit {
        background-color: red;
      }
    .exit:hover {
      background-color: #8B0000;
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

    <div class="container"> 
    <div class="profile-picture">
        <!-- Menggunakan gambar profil dari database jika tersedia -->
        <?php if (isset($profile_picture)) : ?>
            <img src="<?php echo $profile_picture; ?>" alt="Profil Pengguna" />
        <?php else : ?>
            <!-- Jika gambar profil tidak tersedia, tampilkan gambar default atau pesan kesalahan -->
            <img src="user-profile-default.jpg" alt="Profil Pengguna Default" />
        <?php endif; ?>
    </div>
    <div class="user-details">
        <h2><?php echo $username; ?></h2>
        <p>Email: <?php echo $email_pengguna; ?></p>
    </div>
    <div class="button">
        <a href="ubah_foto.php"><button class="change-profile">Ubah Foto Profil</button></a>
        <a href="ubah_profil.php"><button>Ganti Password</button></a>
        <a href="berandaBefore.html"><button class="exit">Keluar</button></a>
    </div>
</div>



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
