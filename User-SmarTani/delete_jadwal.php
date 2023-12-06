<?php
// Membuat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartani";

// Membuka koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $idToDelete = $_GET['id'];

    // Validasi ID (misalnya, pastikan ID adalah bilangan bulat positif)
    if (!is_numeric($idToDelete) || $idToDelete < 1) {
        echo "ID tidak valid.";
    } else {
        // Mencegah SQL Injection
        $idToDelete = mysqli_real_escape_string($conn, $idToDelete);

        // Query SQL DELETE
        $sql = "DELETE FROM tb_jadwal WHERE id = $idToDelete";

        // Menjalankan query DELETE
        if (mysqli_query($conn, $sql)) {
             echo '<script language="javascript">
              alert ("jadwal berhasil dihapus");
              window.location="tabel_jadwal.php";
              </script>';
              exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Menutup koneksi
mysqli_close($conn);
?>
