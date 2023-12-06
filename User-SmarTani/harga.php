<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"
    />
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
        min-height: 100vh;
      }
      .judul {
        text-align: center;
        margin-bottom: 20px;
        margin-top: 20px;
      }
      /* Custom CSS for styling the slider */
      .slider-container {
        text-align: center;
        position: relative;
      }
      .slider {
        width: 80%;
        margin: 0 auto;
      }
      .slider .item {
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .slider .item img {
        max-width: 100%;
        height: auto;
        border-radius: 50%;
        width: 100px; /* Atur ukuran sesuai kebutuhan */
        height: 100px; /* Atur ukuran sesuai kebutuhan */
        margin: 10px 0;
      }

      /* CSS for the item text (barang dan harga) */
      .slider .item h3,
      .slider .item p {
        margin: 5px 0;
      }

      /* CSS for slider buttons */
      .prev,
      .next {
        display: block;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        padding: 10px 20px;
        background-color: #004a15;
        color: white;
        border: none;
        cursor: pointer;
      }

      .prev {
        left: 0;
      }

      .next {
        right: 0;
      }

      .prev:hover,
      .next:hover {
        background-color: #00390e;
      }

      /* Media query for responsiveness */
      @media (max-width: 768px) {
        .slider {
          width: 90%;
        }
        .slider .item {
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
      <div class="judul">
        <h2>Harga Komoditas Pertanian Terkini</h2>
      </div>
      <div class="slider-container">
        <div class="slider">
        <div class="item">
            <h3>Kacang Merah</h3>
            <img
              src="/smartani/lokasi_upload/kacang merah.jpeg"
              alt="Kacang Merah"
            />
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "smartani";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // depok
                $sql_depok = "SELECT harga FROM harga WHERE nama = 'kacang merah' AND daerah = 'depok'";
                $result_depok = $conn->query($sql_depok);

                if ($result_depok->num_rows > 0) {
                    $row_depok = $result_depok->fetch_assoc();
                    $harga_rupiah_depok = number_format($row_depok['harga'], 0, ',', '.');
                ?>
                    <p>Depok: Rp <?php echo $harga_rupiah_depok; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Bogor
                $sql_bogor = "SELECT harga FROM harga WHERE nama = 'kacang merah' AND daerah = 'bogor'";
                $result_bogor = $conn->query($sql_bogor);
                
                if ($result_bogor->num_rows > 0) {
                  $row_bogor = $result_bogor->fetch_assoc();
                  $harga_rupiah_bogor = number_format($row_bogor['harga'], 0, ',', '.');
                ?>
                    <p>Bogor: Rp <?php echo $harga_rupiah_bogor; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Jakarta
                $sql_jkt = "SELECT harga FROM harga WHERE nama = 'kacang merah' AND daerah = 'jakarta'";
                $result_jkt = $conn->query($sql_jkt);
                
                if ($result_jkt->num_rows > 0) {
                  $row_jkt = $result_jkt->fetch_assoc();
                  $harga_rupiah_jkt = number_format($row_jkt['harga'], 0, ',', '.');
                ?>
                    <p>Jakarta: Rp <?php echo $harga_rupiah_jkt; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                $conn->close();
                ?>
          </div>
          <div class="item">
            <h3>Kacang Hijau</h3>
            <img
              src="/smartani/lokasi_upload/kacang hijau.jpeg"
              alt="Kacang Hijau"
            />
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "smartani";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // depok
                $sql_depok = "SELECT harga FROM harga WHERE nama = 'kacang hijau' AND daerah = 'depok'";
                $result_depok = $conn->query($sql_depok);

                if ($result_depok->num_rows > 0) {
                    $row_depok = $result_depok->fetch_assoc();
                    $harga_rupiah_depok = number_format($row_depok['harga'], 0, ',', '.');
                ?>
                    <p>Depok: Rp <?php echo $harga_rupiah_depok; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Bogor
                $sql_bogor = "SELECT harga FROM harga WHERE nama = 'kacang hijau' AND daerah = 'bogor'";
                $result_bogor = $conn->query($sql_bogor);
                
                if ($result_bogor->num_rows > 0) {
                  $row_bogor = $result_bogor->fetch_assoc();
                  $harga_rupiah_bogor = number_format($row_bogor['harga'], 0, ',', '.');
                ?>
                    <p>Bogor: Rp <?php echo $harga_rupiah_bogor; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Jakarta
                $sql_jkt = "SELECT harga FROM harga WHERE nama = 'kacang hijau' AND daerah = 'jakarta'";
                $result_jkt = $conn->query($sql_jkt);
                
                if ($result_jkt->num_rows > 0) {
                  $row_jkt = $result_jkt->fetch_assoc();
                  $harga_rupiah_jkt = number_format($row_jkt['harga'], 0, ',', '.');
                ?>
                    <p>Jakarta: Rp <?php echo $harga_rupiah_jkt; ?></p>
                <?php
                } else {
                    echo "Harga di Jakarta belum tersedia";
                }

                $conn->close();
                ?>
          </div>
          <div class="item">
            <h3>Beras</h3>
            <img
              src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRWcJCH8f7zKRnkKVRqoI447MGjpq7m8CvowEkGj-bMFU9GdGxdgl4Pm2jA7ZYe"
              alt="Beras"
            />
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "smartani";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // depok
                $sql_depok = "SELECT harga FROM harga WHERE nama = 'beras' AND daerah = 'depok'";
                $result_depok = $conn->query($sql_depok);

                if ($result_depok->num_rows > 0) {
                    $row_depok = $result_depok->fetch_assoc();
                    $harga_rupiah_depok = number_format($row_depok['harga'], 0, ',', '.');
                ?>
                    <p>Depok: Rp <?php echo $harga_rupiah_depok; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Bogor
                $sql_bogor = "SELECT harga FROM harga WHERE nama = 'beras' AND daerah = 'bogor'";
                $result_bogor = $conn->query($sql_bogor);
                
                if ($result_bogor->num_rows > 0) {
                  $row_bogor = $result_bogor->fetch_assoc();
                  $harga_rupiah_bogor = number_format($row_bogor['harga'], 0, ',', '.');
                ?>
                    <p>Bogor: Rp <?php echo $harga_rupiah_bogor; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Jakarta
                $sql_jkt = "SELECT harga FROM harga WHERE nama = 'beras' AND daerah = 'jakarta'";
                $result_jkt = $conn->query($sql_jkt);
                
                if ($result_jkt->num_rows > 0) {
                  $row_jkt = $result_jkt->fetch_assoc();
                  $harga_rupiah_jkt = number_format($row_jkt['harga'], 0, ',', '.');
                ?>
                    <p>Jakarta: Rp <?php echo $harga_rupiah_jkt; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                $conn->close();
                ?>
          </div>
          <div class="item">
            <h3>Jagung</h3>
            <img
              src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcR2q3c_5m9GkLTNyufYnXY6QyVEW0Ki1KVZbwzolaE8vIb0eMz6Go4K3w0tObv7"
              alt="Jagung"
            />
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "smartani";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // depok
                $sql_depok = "SELECT harga FROM harga WHERE nama = 'jagung' AND daerah = 'depok'";
                $result_depok = $conn->query($sql_depok);

                if ($result_depok->num_rows > 0) {
                    $row_depok = $result_depok->fetch_assoc();
                    $harga_rupiah_depok = number_format($row_depok['harga'], 0, ',', '.');
                ?>
                    <p>Depok: Rp <?php echo $harga_rupiah_depok; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Bogor
                $sql_bogor = "SELECT harga FROM harga WHERE nama = 'jagung' AND daerah = 'bogor'";
                $result_bogor = $conn->query($sql_bogor);
                
                if ($result_bogor->num_rows > 0) {
                  $row_bogor = $result_bogor->fetch_assoc();
                  $harga_rupiah_bogor = number_format($row_bogor['harga'], 0, ',', '.');
                ?>
                    <p>Bogor: Rp <?php echo $harga_rupiah_bogor; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Jakarta
                $sql_jkt = "SELECT harga FROM harga WHERE nama = 'jagung' AND daerah = 'jakarta'";
                $result_jkt = $conn->query($sql_jkt);
                
                if ($result_jkt->num_rows > 0) {
                  $row_jkt = $result_jkt->fetch_assoc();
                  $harga_rupiah_jkt = number_format($row_jkt['harga'], 0, ',', '.');
                ?>
                    <p>Jakarta: Rp <?php echo $harga_rupiah_jkt; ?></p>
                <?php
                } else {
                    echo "Harga di Jakarta belum tersedia";
                }

                $conn->close();
                ?>
          </div>
          <div class="item">
            <h3>Kacang Tanah</h3>
            <img
              src="/smartani/lokasi_upload/kacang tanah.jpeg"
              alt="Kacang Tanah"
            />
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "smartani";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // depok
                $sql_depok = "SELECT harga FROM harga WHERE nama = 'kacang tanah' AND daerah = 'depok'";
                $result_depok = $conn->query($sql_depok);

                if ($result_depok->num_rows > 0) {
                    $row_depok = $result_depok->fetch_assoc();
                    $harga_rupiah_depok = number_format($row_depok['harga'], 0, ',', '.');
                ?>
                    <p>Depok: Rp <?php echo $harga_rupiah_depok; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Bogor
                $sql_bogor = "SELECT harga FROM harga WHERE nama = 'kacang tanah' AND daerah = 'bogor'";
                $result_bogor = $conn->query($sql_bogor);
                
                if ($result_bogor->num_rows > 0) {
                  $row_bogor = $result_bogor->fetch_assoc();
                  $harga_rupiah_bogor = number_format($row_bogor['harga'], 0, ',', '.');
                ?>
                    <p>Bogor: Rp <?php echo $harga_rupiah_bogor; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                // Jakarta
                $sql_jkt = "SELECT harga FROM harga WHERE nama = 'kacang tanah' AND daerah = 'jakarta'";
                $result_jkt = $conn->query($sql_jkt);
                
                if ($result_jkt->num_rows > 0) {
                  $row_jkt = $result_jkt->fetch_assoc();
                  $harga_rupiah_jkt = number_format($row_jkt['harga'], 0, ',', '.');
                ?>
                    <p>Jakarta: Rp <?php echo $harga_rupiah_jkt; ?></p>
                <?php
                } else {
                    echo "Price not available";
                }

                $conn->close();
                ?>
          </div>
          <!-- Inside the "Kedelai" div -->
<div class="item">
    <h3>Kedelai</h3>
    <img src="/smartani/lokasi_upload/kedelai.jpeg" alt="Kedelai" />

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smartani";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // depok
    $sql_depok = "SELECT harga FROM harga WHERE nama = 'Kedelai' AND daerah = 'depok'";
    $result_depok = $conn->query($sql_depok);

    if ($result_depok->num_rows > 0) {
        $row_depok = $result_depok->fetch_assoc();
        $harga_rupiah_depok = number_format($row_depok['harga'], 0, ',', '.');
    ?>
        <p>Depok: Rp <?php echo $harga_rupiah_depok; ?></p>
    <?php
    } else {
        echo "Price not available";
    }

      // Bogor
    $sql_bogor = "SELECT harga FROM harga WHERE nama = 'kedelai' AND daerah = 'bogor'";
    $result_bogor = $conn->query($sql_bogor);

  
    if ($result_bogor->num_rows > 0) {
      $row_bogor = $result_bogor->fetch_assoc();
      $harga_rupiah_bogor = number_format($row_bogor['harga'], 0, ',', '.');
    ?>
        <p>Bogor: Rp <?php echo $harga_rupiah_bogor; ?></p>
    <?php
    } else {
        echo "Price not available";
    }

    // Jakarta
    $sql_jkt = "SELECT harga FROM harga WHERE nama = 'kedelai' AND daerah = 'jakarta'";
    $result_jkt = $conn->query($sql_jkt);
    
    if ($result_jkt->num_rows > 0) {
      $row_jkt = $result_jkt->fetch_assoc();
      $harga_rupiah_jkt = number_format($row_jkt['harga'], 0, ',', '.');
    ?>
        <p>Jakarta: Rp <?php echo $harga_rupiah_jkt; ?></p>
    <?php
    } else {
        echo "Harga di Jakarta belum tersedia";
    }

    $conn->close();
    ?>
</div>

          <!-- Tambahkan lebih banyak barang sesuai kebutuhan -->
        </div>
        <button class="prev">Sebelumnya</button>
        <button class="next">Selanjutnya</button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
      $(document).ready(function () {
        var slider = $(".slider");
        slider.slick({
          slidesToShow: 3,
          slidesToScroll: 3,
          prevArrow: $(".prev"),
          nextArrow: $(".next"),
        });
      });
    </script>
  </body>
</html>
