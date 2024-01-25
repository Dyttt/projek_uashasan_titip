<?php
$servername = "localhost";  // Ganti dengan nama host database Anda
$username = "root";    // Ganti dengan username database Anda
$password = "";    // Ganti dengan password database Anda
$dbname = "NextGen"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "Koneksi berhasil";

// Lakukan operasi database di sini

// Tutup koneksi setelah selesai
$conn->close();
?>
