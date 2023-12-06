<?php
// Sertakan file TCPDF
require_once('tcpdf/tcpdf.php');

// Buat instance TCPDF
$pdf = new TCPDF();

// Set informasi dokumen
$pdf->SetCreator('SmarTani');
$pdf->SetAuthor('SmarTani');
$pdf->SetTitle('Daftar Tanaman');

// Mulai halaman
$pdf->AddPage();

// Query untuk mengambil data tanaman dari tabel tanaman berdasarkan jenis tanah
$koneksi = new mysqli("localhost", "root", "", "smartani");

$jenisTanah = isset($_GET['jenisTanah']) ? $_GET['jenisTanah'] : "";

if (!empty($jenisTanah)) {
    // Query untuk mengambil data tanaman dari tabel tanaman (sesuaikan nama tabel dan strukturnya)
    $query = "SELECT * FROM tanaman WHERE jenis = '$jenisTanah'";

    // Eksekusi query
    $result = $koneksi->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Tambahkan judul
            $pdf->SetFont('times', 'B', 14);
            $pdf->Cell(0, 10, 'Nama: ' . $row['nama'], 0, 1);

            // Tambahkan deskripsi
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(0, 10, 'Deskripsi: ' . $row['deskripsi'], 0, 1);

            // Tambahkan gambar
            $gambarPath = 'lokasi_upload/' . $row['gambar']; // Sesuaikan dengan lokasi penyimpanan gambar
            $pdf->Image($gambarPath, 15, $pdf->GetY(), 60, 60); // Sesuaikan dengan koordinat dan dimensi gambar
            $pdf->Ln(70); // Pindah ke baris baru
        }
    } else {
        $pdf->Cell(0, 10, 'Error: ' . $query . $koneksi->error, 0, 1);
    }

    // Tutup koneksi database
    $koneksi->close();
} else {
    $pdf->Cell(0, 10, 'Error: jenisTanah tidak ditemukan.', 0, 1);
}

// Keluarkan dokumen PDF
$pdf->Output('Daftar_Tanaman.pdf', 'I');
?>
