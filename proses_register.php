<?php 
    session_start();
    include 'koneksi.php';

    $nama = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek_user=mysqli_num_rows(mysqli_query($konek, "SELECT * FROM login WHERE nama='$nama' or email='$email' and password='$password'"));
    if ($cek_user > 0) {
        echo '<script language="javascript">
              alert ("Username Sudah Ada Yang Menggunakan");
              window.location="register.php";
              </script>';
              exit();
    }
    else {
        $password = md5($_POST['password']);
        mysqli_query($konek,"INSERT INTO login (id, nama, email, password)
        VALUES ('$_POST[id]', '$_POST[nama]', '$_POST[email]','$password')");
        
        echo '<script language="javascript">
              alert ("Registrasi Berhasil Di Lakukan!");
              window.location="login.php";
              </script>';
              exit();
    }
?>

