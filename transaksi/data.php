<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_konek.php');

    $user = $_POST['username'];
    $pilih = $_POST['packet'];
    $bayar = $_POST['metode_pembayaran'];
    $total = $_POST['total_bayar'];

    // Gunakan prepared statement untuk menghindari SQL injection
    $sql = $conn->prepare("INSERT INTO pembelian (username, packet, total_bayar, metode_pembayaran) 
                           VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameter ke statement
    $sql->bind_param("ssssss", $user, $pilih, $bayar, $total);

    // Eksekusi statement dan redirect jika berhasil
    if ($sql->execute()) header("Location: pembelian.html");
    else echo "Error: " . $sql->error;

    // Tutup statement dan koneksi
    $sql->close();
    $conn->close();
}
?>

