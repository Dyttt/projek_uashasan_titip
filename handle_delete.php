<?php
// handle_delete.php

session_start(); // Mulai sesi

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Include file koneksi database (sesuaikan dengan nama file dan lokasi Anda)
    include('db_konek.php');

    // Ambil ID dari URL
    $id = $_GET['id'];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Gunakan prepared statement untuk menghindari SQL injection
    $sql = $conn->prepare("DELETE FROM member WHERE id_member = ?");
    $sql->bind_param("s", $id);

    if ($sql->execute()) {
        // Pesan berhasil dihapus
        echo "Data dengan ID $id berhasil dihapus.";
    } else {
        // Pesan gagal dihapus
        echo "Gagal menghapus data. Silakan coba lagi.";
    }

    // Tutup prepared statement
    $sql->close();
    $conn->close();
} else {
    // Jika bukan metode GET, mungkin hendak diarahkan ke halaman lainnya
    header("Location: Data.php");
    exit();
}
?>
