<?php 
    session_start();
    include 'koneksi.php';
 
    // menangkap data yang dikirim dari form login
    $email = $_POST['email'];
    $password = md5($_POST['password']);
 
    // menyeleksi data pada tabel admin dengan username dan password yang sesuai
    $data = mysqli_query($konek, "SELECT * FROM login WHERE email='$email' and password='$password'");
 
    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($data);
 
    if($cek > 0){
        $_SESSION['email'] = $email;
        $_SESSION['status'] = "login";
     echo '<script language="javascript">
              alert ("anda berhasil login");
              window.location="beranda.php";
              </script>';
              exit();
    }
    else{
     echo '<script language="javascript">
              alert ("email atau password salah");
              window.location="login.php";
              </script>';
              exit();
    }
?>