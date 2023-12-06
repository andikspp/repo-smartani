<?php 
$konek = new mysqli("localhost", "root", "", "smartani");

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Use prepared statements to prevent SQL injection
$stmt = $konek->prepare("SELECT * FROM admin WHERE username=? OR email=?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

$cek_user = $stmt->num_rows;

if ($cek_user > 0) {
    echo '<script language="javascript">
          alert ("Username atau Email Sudah Ada Yang Menggunakan");
          window.location="register.php";
          </script>';
    exit();
} else {
    // Use password_hash to securely hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to insert data into the database
    $stmt = $konek->prepare("INSERT INTO admin (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $stmt->execute();
    
    echo '<script language="javascript">
          alert ("Registrasi Berhasil Di Lakukan!");
          window.location="login.php";
          </script>';
    exit();
}
?>
