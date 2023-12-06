<?php
$konek = new mysqli("localhost", "root", "", "smartani");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
    $token = $_GET["token"];

    $stmt = $konek->prepare("SELECT * FROM users WHERE verification_token=?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    $result = $stmt->num_rows;

    if ($result > 0) {
        // Update user status to verified
        $update_stmt = $konek->prepare("UPDATE users SET status='verified' WHERE verification_token=?");
        $update_stmt->bind_param("s", $token);
        $update_stmt->execute();

        echo '<script language="javascript">
              alert ("Verifikasi Email Berhasil. Silakan login.");
              window.location="login.php";
              </script>';
        exit();
    } else {
        echo '<script language="javascript">
              alert ("Token verifikasi tidak valid.");
              window.location="login.php";
              </script>';
        exit();
    }
} else {
    echo '<script language="javascript">
          alert ("Permintaan tidak valid.");
          window.location="login.php";
          </script>';
    exit();
}
?>
