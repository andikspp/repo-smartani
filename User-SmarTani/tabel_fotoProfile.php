<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "smartani";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL untuk membuat tabel user_profiles
    $createTableSQL = "CREATE TABLE IF NOT EXISTS user_profiles (
        profile_id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        profile_picture VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";

    // Eksekusi SQL untuk membuat tabel
    $pdo->exec($createTableSQL);

    echo "Tabel user_profiles berhasil dibuat.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
