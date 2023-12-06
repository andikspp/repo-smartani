<?php
$server = "localhost"; // Nama server database (biasanya localhost)
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = ""; // Ganti dengan kata sandi MySQL Anda
$database = "smartani"; // Ganti dengan nama database Anda

// Membuat koneksi
$koneksi = new mysqli($server, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}
?>

<?php
// Query untuk membuat tabel tanaman
$query = "CREATE TABLE tanaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    jenis VARCHAR(50),
    deskripsi TEXT,
    gambar VARCHAR(255)
)";

// Menjalankan query
if ($koneksi->query($query) === TRUE) {
    echo "Tabel tanaman telah dibuat.";
} else {
    echo "Error saat membuat tabel: " . $koneksi->error;
}

// Menutup koneksi
$koneksi->close();
?>
