<!DOCTYPE html>
<html>
<head>
    <title>Form Input Tanaman</title>
    <link rel="stylesheet" type="text/css" href="input_tanaman.css">
</head>
<body>
    <h1>Form Input Tanaman</h1>
    <form action="input_tanaman.php" method="post" enctype="multipart/form-data">
        <label for="nama">Nama Tanaman:</label>
        <input type="text" name="nama" required>
        <br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" required></textarea>
        <br>

        <label for="jenis">Jenis Tanah:</label>
        <input type="text" name="jenis" required>
        <br>

        <label for="gambar">Gambar Tanaman:</label>
        <input type="file" name="gambar" accept="image/*" required>
        <br>

        <input type="submit" name="submit" value="Simpan">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama']; 
        $jenis = $_POST['jenis'];
        $deskripsi = $_POST['deskripsi'];

        // Periksa apakah file gambar telah diunggah
        if (isset($_FILES['gambar'])) {
            // Handle gambar yang diunggah
            $gambar = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];
            $gambar_path = 'C:/xampp/htdocs/smartani/lokasi_upload/' . $gambar;

            // Buat koneksi ke database (sesuaikan dengan pengaturan Anda)
            $koneksi = new mysqli("localhost", "root", "", "smartani");

            // Pindahkan file gambar ke lokasi upload yang diinginkan
            if (move_uploaded_file($gambar_tmp, $gambar_path)) {
                // File gambar berhasil diunggah, Anda dapat menyimpan nama file ini ke database
                // Selanjutnya, tambahkan kode untuk menyimpan $gambar ke tabel tanaman
                $query = "INSERT INTO tanaman (nama, jenis, deskripsi, gambar) VALUES ('$nama', '$jenis', '$deskripsi', '$gambar')";

                if ($koneksi->query($query) === TRUE) {
                    echo "Data dan gambar berhasil dimasukkan ke dalam database. <a href='input_tanaman.php'>Kembali</a>";
                } else {
                    echo "Error: " . $query . "<br>" . $koneksi->error;
                }
            } else {
                echo "Gagal mengunggah gambar. <a href='tanaman.php'>Kembali</a>";
            }
        } else {
            echo "Gambar belum diunggah. Pastikan Anda memilih file gambar untuk diunggah.";
        }
    }
    ?>
</body>
</html>
