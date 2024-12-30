<?php

// Konfigurasi Database
$host = "localhost"; // Ganti dengan host database Anda
$dbname = "bio"; // Ganti dengan nama database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda

// Buat koneksi ke database menggunakan PDO
try {
    $koneksi = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Atur mode error untuk penanganan error dengan pengecualian (exceptions)
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>


