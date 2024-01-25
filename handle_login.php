<?php
// handle_login.php

session_start(); // Mulai sesi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi database (sesuaikan dengan nama file dan lokasi Anda)
    include('db_konek.php');

    // Ambil data dari formulir login
    $user = $_POST['User_Member'];
    $pass = $_POST['password'];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Gunakan prepared statement untuk menghindari SQL injection
    $sql = $conn->prepare("SELECT * FROM member WHERE User_Member = ? AND password = ?");
    $sql->bind_param("ss", $user, $pass);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil
        $_SESSION['user_member'] = $user; // Set variabel sesi untuk menandai bahwa pengguna telah login

        // Tutup prepared statement
        $sql->close();

        // Tutup koneksi setelah selesai menggunakan hasil prepared statement
        $conn->close();

        // Redirect ke halaman Data.php
        header("Location: Data.php");
        exit();
    } else {
        // Login gagal
        echo "Login gagal. Silakan coba lagi.";

        // Tutup prepared statement
        $sql->close();

        // Tutup koneksi setelah selesai menggunakan hasil prepared statement
        $conn->close();
    }
} else {
    // Jika bukan metode POST, mungkin hendak diarahkan ke halaman login atau halaman lainnya
    header("Location: login.php");
    exit();
}
?>
