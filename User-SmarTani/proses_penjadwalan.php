<?php
session_start();

// Koneksi
include 'koneksi.php';
$konek = new mysqli("localhost", "root", "", "smartani");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Cek apakah tombol submit sudah pernah ditekan
if (isset($_POST["submit"])) {
    // Ambil data dari tiap elemen dalam form dan terapkan htmlspecialchars
    $nama_kegiatan = htmlspecialchars($_POST["nama_kegiatan"]);
    $jenis_tanaman = htmlspecialchars($_POST["jenis_tanaman"]);
    $tanggal = htmlspecialchars($_POST["tanggal"]);

    // Query insert data
    $query = "INSERT INTO tb_jadwal (id_user, nama_kegiatan, jenis_tanaman, tanggal) 
              VALUES ('$user_id', '$nama_kegiatan', '$jenis_tanaman', '$tanggal')";

    // Eksekusi query
    if (mysqli_query($konek, $query)) {
        echo '<script language="javascript">
              alert ("jadwal berhasil dibuat");
              window.location="/smartani/User-SmarTani/tabel_jadwal.php";
              </script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>
