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

    // Query untuk mengambil nama file gambar tanaman
    $query_select_gambar = "SELECT gambar FROM tanaman WHERE id = $id";
    $result_select_gambar = $conn->query($query_select_gambar);

    if ($result_select_gambar->num_rows > 0) {
        $row_select_gambar = $result_select_gambar->fetch_assoc();
        $gambar_tanaman = $row_select_gambar['gambar'];

        // Hapus gambar dari direktori
        if (!empty($gambar_tanaman) && file_exists("lokasi_upload/" . $gambar_tanaman)) {
            unlink("lokasi_upload/" . $gambar_tanaman);
        }

        // Query untuk menghapus tanaman dari database
        $query_delete_tanaman = "DELETE FROM tanaman WHERE id = $id";

        if ($conn->query($query_delete_tanaman) === TRUE) {
            echo "<h2>Data tanaman berhasil dihapus.</h2>";
            echo "<a href='tanaman.php'>Kembali ke Halaman Tanaman</a>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Data tanaman tidak ditemukan.";
    }
} else {
    echo "Permintaan tidak valid.";
}

// Menutup koneksi database
$conn->close();
?>
