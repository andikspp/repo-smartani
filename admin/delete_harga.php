<?php
// Mengatur koneksi ke database MySQL
$servername = "localhost"; // Ganti dengan nama server database Anda
$db_username = "root"; // Ganti dengan nama pengguna database Anda
$db_password = ""; // Ganti dengan kata sandi database Anda
$dbname = "smartani"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Query untuk menghapus harga dari database
    $query_delete_harga = "DELETE FROM harga WHERE id = $id";

    if ($conn->query($query_delete_harga) === TRUE) {
        echo "<h2>Data harga berhasil dihapus.</h2>";
        echo "<a href='kelola_harga.php'>Kembali ke Halaman Kelola Harga</a>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Permintaan tidak valid.";
}

// Menutup koneksi database
$conn->close();
?>
