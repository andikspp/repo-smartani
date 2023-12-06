<!DOCTYPE html>
<html>
<head>
    <title>Edit Tanaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    // Mengecek koneksi ke database MySQL
    $servername = "localhost"; // Sesuaikan dengan nama server database Anda
    $db_username = "root"; // Sesuaikan dengan nama pengguna database Anda
    $db_password = ""; // Sesuaikan dengan kata sandi database Anda
    $dbname = "smartani"; // Sesuaikan dengan nama database Anda

    // Membuat koneksi
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $deskripsi = $_POST["deskripsi"];
        $jenis = $_POST["jenis"];

        // Periksa apakah file gambar baru diunggah
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
            $gambar = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];
            $gambar_path = 'C:/xampp/htdocs/smartani/lokasi_upload/' . $gambar;

            // Pindahkan file gambar baru ke lokasi upload yang diinginkan
            if (move_uploaded_file($gambar_tmp, $gambar_path)) {
                // Hapus gambar lama jika berhasil mengunggah gambar baru
                $query_hapus_gambar = "SELECT gambar FROM tanaman WHERE id = $id";
                $result_hapus_gambar = $conn->query($query_hapus_gambar);
                
                if ($result_hapus_gambar->num_rows > 0) {
                    $row_hapus_gambar = $result_hapus_gambar->fetch_assoc();
                    $gambar_lama = $row_hapus_gambar['gambar'];
                    
                    // Hapus gambar lama dari direktori
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/smartani/lokasi_upload/' . $gambar_lama);
                }

                // Update data tanaman ke database
                $query_update = "UPDATE tanaman SET nama='$nama', jenis='$jenis', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";
            } else {
                echo "Gagal mengunggah gambar baru. <a href='tanaman.php'>Kembali</a>";
                exit();
            }
        } else {
            // Update data tanaman tanpa mengubah gambar
            $query_update = "UPDATE tanaman SET nama='$nama', jenis='$jenis', deskripsi='$deskripsi' WHERE id=$id";
        }

        // Eksekusi query update
        if ($conn->query($query_update) === TRUE) {
            echo "<h2>Data tanaman berhasil diupdate.</h2>";
            echo "<a href='tanaman.php'>Kembali</a>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        $id = $_GET["id"];

        // Query untuk mengambil data tanaman berdasarkan ID
        $sql = "SELECT * FROM tanaman WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nama = $row["nama"];
            $deskripsi = $row["deskripsi"];
            $jenis = $row["jenis"];
        } else {
            echo "Data tanaman tidak ditemukan.";
        }
    }
    ?>

    <h2>Edit Data Tanaman</h2>
    <form action="update_tanaman.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="nama">Nama Tanaman:</label>
        <input type="text" name="nama" value="<?php echo $nama; ?>" required><br><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" required><?php echo $deskripsi; ?></textarea><br><br>

        <label for="jenis">Jenis Tanaman:</label>
        <input type="text" name="jenis" value="<?php echo $jenis; ?>" required><br><br>

        <label for="gambar">Gambar Tanaman:</label>
        <input type="file" name="gambar" accept="image/*"><br><br>

        <input type="submit" value="Update Data">
    </form>
</body>
</html>
