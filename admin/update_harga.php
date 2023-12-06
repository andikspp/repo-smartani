<?php
// Mengatur koneksi ke database MySQL
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

// Memeriksa apakah formulir telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirimkan melalui formulir
    $id = $_POST["id"];
    $harga = $_POST["harga"];

    // Pastikan ID dan harga adalah bilangan bulat positif
    if (!is_numeric($id) || !is_numeric($harga) || $id <= 0 || $harga <= 0) {
        die("ID atau harga tidak valid.");
    }

    // Query untuk mengupdate harga berdasarkan id
    $sql = "UPDATE harga SET harga=$harga WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Harga berhasil diupdate. <a href='harga.php'>Kembali</a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET["id"];

    // Query untuk mengambil data harga berdasarkan ID
    $sql = "SELECT * FROM harga WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $harga = $row["harga"];
    } else {
        echo "Data harga tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Harga</title>
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

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
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
    <h2>Update Harga</h2>
    <form action="update_harga.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="harga">Harga:</label>
        <input type="text" name="harga" value="<?php echo $harga; ?>" required><br><br>

        <input type="submit" value="Update Harga">
    </form>
</body>
</html>
