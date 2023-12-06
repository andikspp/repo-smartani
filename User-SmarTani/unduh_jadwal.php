<?php
session_start();
$konek = new mysqli("localhost", "root", "", "smartani");

$user_id = $_SESSION['user_id'];

// Execute the query and fetch the results
$result = $konek->query("SELECT * FROM tb_jadwal WHERE id_user = '$user_id'");
$jadwal = $result->fetch_all(MYSQLI_ASSOC);

// Set the response headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="penjadwalan.csv"');

// Open output stream for writing CSV data
$output = fopen('php://output', 'w');

// Write CSV header
fputcsv($output, array('ID', 'Nama Kegiatan', 'Jenis Tanaman', 'Tanggal'));

// Write CSV data
foreach ($jadwal as $row) {
    fputcsv($output, array($row["id"], $row["nama_kegiatan"], $row["jenis_tanaman"], $row["tanggal"]));
}

// Close the output stream
fclose($output);
?>
