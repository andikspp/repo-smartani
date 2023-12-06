<!DOCTYPE html>
<html>
<head>
    <title>Form Input Harga</title>
    <link rel="stylesheet" type="text/css" href="/smartani/admin/input_tanaman.css">
</head>
<body>
    <h1>Form Input Harga Tanaman</h1>
    <form action="input_harga.php" method="post" enctype="multipart/form-data">
        <label for="nama">Nama Tanaman:</label>
        <select name="jtanaman" required>
            <option value="">Pilih Jenis Tanaman</option>
            <option value="jagung">Jagung</option>
            <option value="beras">Beras</option>
            <option value="kacang tanah">Kacang Tanah</option>
            <option value="Kacang hijau">Kacang Hijau</option>
            <option value="kacang merah">Kacang Merah</option>
            <option value="kedelai">Kedelai</option>
          </select>
        <br>

        <label for="harga">Harga:</label>
        <input type="text" name="harga" required>
        <br>

        <label for="daerah">Daerah:</label>
        <select name="daerah" required>
            <option value="">Pilih Daerah</option>
            <option value="jakarta">Jakarta</option>
            <option value="depok">Depok</option>
            <option value="bogor">Bogor</option>
          </select>
        <br>

        <label for="tanggal">per tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required>
        <br>

        <input type="submit" name="submit" value="Simpan">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jtanaman = $_POST['jtanaman']; 
        $harga = $_POST['harga'];
        $daerah = $_POST['daerah'];
        $tanggal = $_POST['tanggal'];

        // Buat koneksi ke database (sesuaikan dengan pengaturan Anda)
        $koneksi = new mysqli("localhost", "root", "", "smartani");

        if (isset($_POST["submit"])) {
            // Ambil data dari tiap elemen dalam form dan terapkan htmlspecialchars
            $jtanaman = htmlspecialchars($_POST["jtanaman"]);
            $harga = htmlspecialchars($_POST["harga"]);
            $daerah = htmlspecialchars($_POST["daerah"]);
            $tanggal = htmlspecialchars($_POST["tanggal"]);
        }
        
        
            // Query insert data
            $query = "INSERT INTO harga 
                      VALUES 
                      ('', '$jtanaman', '$harga', '$daerah', '$tanggal')";
            
            // Eksekusi query
            if (mysqli_query($koneksi, $query)) {
                echo '<script language="javascript">
                          alert ("Harga berhasil diinput");
                      </script>';
                // Arahkan ke halaman kelola_harga.php
                header("Location: kelola_harga.php");
                exit(); // Pastikan untuk keluar setelah header diarahkan
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
            }
            

    }
    ?>
</body>
</html>
