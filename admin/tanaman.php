<?php
// Informasi koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "smartani";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Query SQL untuk mengambil data tanaman
$sql = "SELECT * FROM tanaman";
$result = $conn->query($sql);

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tanaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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

      .action-button {
        background-color: #4CAF50; /* Warna hijau untuk tombol "Update" */
        color: white;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    .delete-button {
        background-color: #f44336; /* Warna merah untuk tombol "Delete" */
        color: white;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn_insert{
        display: flex;
        justify-content: center;
      }

      .insert-button {
            width: 120px;
            margin: 10px 0; /* Mengatur margin atas dan bawah menjadi 10px, menghilangkan margin kiri dan kanan */
            padding: 10px;
            text-align: center;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            justify-content: center;
            align-items: center;
        }

        .insert-button:hover {
            background-color: #0056b3;
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
    <h2>Daftar Tanaman</h2>

    <table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Tanaman</th>
            <th>Jenis Tanaman</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Menampilkan data tanaman dalam tabel
        if ($result->num_rows > 0) {
            $nomor = 1; // Inisialisasi nomor
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $nomor . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['jenis'] . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td>
                        <a href='update_tanaman.php?id=" . $row['id'] . "' class='action-button'>Update</a>
                        <a href='delete_tanaman.php?id=" . $row['id'] . "' class='delete-button'>Delete</a>
                    </td>";

                echo "</tr>";
                $nomor++; // Increment nomor setiap kali mengambil data
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data tanaman.</td></tr>";
        }
        ?>
    </tbody>
</table> 
<div class="btn_insert">
<a href="input_tanaman.php"><button class="insert-button">Insert</button></a>
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
