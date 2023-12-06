<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rekomendasi Tanaman</title>
  <style>
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
      transition: background-color 0.3s, font-size 0.3s;
      /* Efek transisi saat hover */
      padding: 5px 10px;
      /* Padding yang diperbesar saat dihover */
      border-radius: 5px;
      /* Tambahkan sedikit radius sudut pada latar belakang */
    }

    header nav ul .menu a:hover {
      background-color: #00390e;
      /* Warna latar belakang saat hover */
      color: white;
      /* Warna teks saat hover */
      font-size: 26px;
      /* Ukuran font yang diperbesar saat hover */
      transition: background-color 0.3s, font-size 0.3s;
      /* Efek transisi saat hover */
    }

    #akun {
      text-decoration: none;
      color: #fff;
      transition: background-color 0.3s, font-size 0.3s;
      /* Efek transisi saat hover */
      padding: 5px 10px;
      /* Padding yang diperbesar saat dihover */
      border-radius: 5px;
      /* Tambahkan sedikit radius sudut pada latar belakang */
    }

    #akun:hover {
      background-color: #00390e;
      /* Warna latar belakang saat hover */
      color: white;
      /* Warna teks saat hover */
      font-size: 26px;
      /* Ukuran font yang diperbesar saat hover */
      transition: background-color 0.3s, font-size 0.3s;
      /* Efek transisi saat hover */
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

    .slider-container {
      width: 80%;
      margin: 0 auto;
      overflow: hidden;
      position: relative;
    }

    /* Gaya Kontainer Halaman */
    .list-tanaman {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f5f5f5;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      min-height: 100vh;
    }

    /* Gaya Judul Halaman */
    .list-tanaman h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    /* Gaya Info Tanaman */
    .list-tanaman .tanaman {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .list-tanaman img {
      max-width: 100%;
      border-radius: 50%; /* Mengubah gambar menjadi lingkaran */
      margin-bottom: 10px;
    }

    .list-tanaman h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .list-tanaman p {
      font-size: 16px;
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

    button {
        background-color: #004a15;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        margin-top: 20px;
        margin-bottom: 20px;
      }

      .unduh {
        display: flex;
        justify-content: center;
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

  <div class="list-tanaman">
    <h1>Rekomendasi Tanaman Anda</h1>
    <div class="tanaman">
      <h1>Daftar Tanaman</h1>
      <ul id="recommended-plant-list">
        <?php
        // Buat koneksi ke database (sesuaikan dengan pengaturan Anda)
        $koneksi = new mysqli("localhost", "root", "", "smartani");

        // Periksa koneksi database
        if ($koneksi->connect_error) {
          die("Koneksi database gagal: " . $koneksi->connect_error);
        }

        $jenisTanah = isset($_GET['jenisTanah']) ? $_GET['jenisTanah'] : "";

        if (!empty($jenisTanah)) {
          // Query untuk mengambil data tanaman dari tabel tanaman (sesuaikan nama tabel dan strukturnya)
          $query = "SELECT * FROM tanaman WHERE jenis = '$jenisTanah'";

          // Eksekusi query
          $result = $koneksi->query($query);

          if ($result) {
            // Tampilkan HTML untuk daftar tanaman
            echo '<ul id="recommended-plant-list">';

            // Loop melalui hasil query dan tampilkan data tanaman
            while ($row = $result->fetch_assoc()) {
              // Tampilkan data tanaman
              echo '<li class="list-item">';
              echo '<img src="/smartani/lokasi_upload/' . $row['gambar'] . '" alt="' . $row['nama'] . '">';
              echo '<h2>' . $row['nama'] . '</h2>';
              echo '<p>' . $row['deskripsi'] . '</p>';
              echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '<footer>';
            // Tambahkan kode footer sesuai kebutuhan
            echo '</footer>';
            echo '</body>';
            echo '</html>';
          } else {
            echo "Error: " . $query . "<br>" . $koneksi->error;
          }
        } else {
          echo "Error: jenisTanah tidak ditemukan.";
        }

        // Tutup koneksi database
        $koneksi->close();
        ?>
      </ul>
    </div>
    <div class="unduh">
    <a href="export_pdf.php?jenisTanah=<?php echo urlencode($jenisTanah); ?>"><button>Unduh</button></a>
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
