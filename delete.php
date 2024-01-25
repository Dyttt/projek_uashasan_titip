<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NextGen";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_member = $_GET["id"];

    // Hapus data dari tabel
    $sql = $conn->prepare("DELETE FROM member WHERE id_member = ?");
    $sql->bind_param("i", $id_member);

    if ($sql->execute()) {
        echo "Data berhasil dihapus. <a href='Data.php'>Kembali</a>";
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
}

$conn->close();
?>
