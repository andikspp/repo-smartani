<?php 
session_start();
$konek = new mysqli("localhost", "root", "", "smartani");

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan prepared statements untuk mencegah SQL injection
$stmt = $konek->prepare("SELECT * FROM admin WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah ada pengguna dengan username yang diberikan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        // Password benar, set variabel sesi
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['id'];  // Tambahkan baris ini
        $_SESSION['status'] = "login";
        
        echo '<script language="javascript">
              alert("Login berhasil");
              window.location="admin.php";
              </script>';
        exit();
    } else {
        // Password salah
        echo '<script language="javascript">
              alert("Username atau Password salah");
              window.location="login.php";
              </script>';
        exit();
    }
} else {
    // Tidak ada pengguna dengan username yang diberikan
    echo '<script language="javascript">
          alert("Username atau Password salah");
          window.location="login.php";
          </script>';
    exit();
}
?>
