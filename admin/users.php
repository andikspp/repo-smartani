<!DOCTYPE html>
<html>
<head>
    <title>Data Pengguna</title>
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

        h1 {
            text-align: center;
        }

        /* Gaya untuk judul tabel */
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Gaya untuk tombol Insert */
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

        /* Gaya untuk tombol Edit */
        .edit-button {
            display: inline-block; 
            padding: 10px;
            text-align: center;
            background-color: #28a745; 
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px; 
        }

        .edit-button:hover {
            background-color: #1e7e34; /* Warna hijau yang lebih gelap saat hover */
        }

         /* Gaya untuk tombol Delete */
         .delete-button {
            display: inline-block;
            padding: 10px;
            text-align: center;
            background-color: #dc3545; /* Warna merah untuk tombol Delete */
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete-button:hover {
            background-color: #c82333; /* Warna merah yang lebih gelap saat hover */
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
       
      .btn_insert{
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
            <li class="menu"><a href="admin.php">Dashboard</a></li>
            <li class="menu"><a href="users.php">Pengguna</a></li>
            <li class="menu"><a href="tanaman.php">Tanaman</a></li>
            <li class="menu"><a href="kelola_harga.php">Harga Komoditas</a></li>
            <li class="menu"><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section>
    <h1>Data Pengguna SmarTani</h1>

<?php
// Mengatur koneksi ke database MySQL
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "smartani"; 

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>";
    // Output data dari setiap baris hasil query
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["username"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>
                    <a class='edit-button' href='formUpdate.php?id=" . $row["id"] . "'>Edit</a>
                    <a class='delete-button' href='deleteUser.php?id=" . $row["id"] . "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data dalam tabel.";
}

// Menutup koneksi database
$conn->close();
?>
<div class="btn_insert">
<a href="formInsert.php"><button class="insert-button">Insert</button></a>
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
