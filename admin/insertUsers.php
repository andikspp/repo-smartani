<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirimkan melalui formulir
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

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

    // Menggunakan password_hash untuk mengamankan password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyisipkan data ke dalam tabel users
    $sql = "INSERT INTO users (username, email, password)
    VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Jika penyisipan berhasil, arahkan pengguna ke halaman users.php
        header("Location: users.php");
        exit(); // Penting untuk menghentikan eksekusi skrip setelah mengarahkan
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi database
    $conn->close();
} else {
    echo "Permintaan tidak valid.";
}
?>
