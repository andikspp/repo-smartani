<!DOCTYPE html>
<?php
session_start(); // Add session_start() to start the session
$konek = new mysqli("localhost", "root", "", "smartani");

$user_id = $_SESSION['user_id'];

// Execute the query and fetch the results
$result = $konek->query("SELECT * FROM tb_jadwal WHERE id_user = '$user_id'");
$jadwal = $result->fetch_all(MYSQLI_ASSOC);
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> halaman admin </title>
</head>
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
        background-color: #f5f5f5; /* Add a light background color */
        border-radius: 10px; /* Add rounded corners */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
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

    /* Styling Table */
    .tabel {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .tabel th, .tabel td {
      padding: 12px;
      text-align: center;
      border: 1px solid #ddd; /* Add border to cells */
    }

    .tabel th {
      background-color: #004a15;
      color: #fff;
    }

    .tabel tr:nth-child(even) {
      background-color: #f9f9f9; /* Alternate row background color */
    }

    a {
    color: #007dab;
    text-decoration: none;
    -moz-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    outline: none;
  }
  a:hover, a:focus {
    color: #333;
    text-decoration: none;
    outline: none;
  }
  
  a.btn_1,
  .btn_1 {
    border: none;
    color: #fff;
    background: #4CAF50;
    cursor: pointer;
    padding: 10px 15px;
    display: inline-block;
    outline: none;
    font-size: 13px;
    font-size: 0.8125rem;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    -webkit-border-radius: 25px;
    -moz-border-radius: 25px;
    -ms-border-radius: 25px;
    border-radius: 25px;
    line-height: 1;
    font-weight: 500;
  }
  a.btn_1.red,
  .btn_1.red {
    background: #fa1414;
    color: #ffff;
    margin-top: 10px;
  }

  a.btn_1.medium,
  .btn_1.medium {
    padding: 12px 45px;
    font-size: 16px;
    font-size: 1rem;
  }

  
  .btn-primary {
    background-color: #007dab;
    border-color: #007dab;
  }
  .btn-primary:hover {
    background-color: #007dab;
    border-color: #007dab;
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

      button:hover {
        background-color: #00390e;
      }

      .btn_jadwal {
        display: flex;
        justify-content: center;
      }

      .btn_jadwal button {
        margin-right: 10px;
      }
</style>
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
  <table class="tabel" border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th> id </th>
      <th> Nama Kegiatan </th>
      <th> Jenis Tanaman </th>
      <th> Tanggal </th>
      <th> Action </th>
    </tr>
    <?php $id = 1; ?>
    <?php foreach ($jadwal as $row) : ?>
    <tr>
      <td> <?= $id; ?> </td>
      <td> <?= $row["nama_kegiatan"]; ?></td>
      <td> <?= $row["jenis_tanaman"]; ?> </td>
      <td> <?= $row["tanggal"]; ?></td>
      <td> 
        <a href="update_jadwal.php?id=<?= $row["id"]; ?>" class = "btn_1"> Update </a> 
        <a href="delete_jadwal.php?id=<?= $row["id"]; ?>" class = "btn_1 red"> Delete </a>
      </td>
    </tr>

    <?php $id++; ?>
    <?php  endforeach;?>
  </table>
    </section>
    <div class="btn_jadwal">
      <a href="Penjadwalan.php"><button>Buat Jadwal</button></a>
      <a href="unduh_jadwal.php"><button>Unduh Penjadwalan</button></a>
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

