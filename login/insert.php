<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_konek.php');

    $user = $_POST['User_Member'];
    $pass = $_POST['password'];
    $emile = $_POST['emile'];
    $no_tlp = $_POST['no_tlp'];

    // Gunakan prepared statement untuk menghindari SQL injection
    $sql = $conn->prepare("INSERT INTO member (User_Member, password, emile, no_tlp, id_member) 
                           VALUES (?, ?, ?, ?, ?, ?)
                           ON DUPLICATE KEY UPDATE id_member = VALUES(id_member)");

    // Bind parameter ke statement
    $sql->bind_param("ssssss", $user, $pass, $emile, $no_tlp);

    // Eksekusi statement dan redirect jika berhasil
    if ($sql->execute()) header("Location: login.php");
    else echo "Error: " . $sql->error;

    // Tutup statement dan koneksi
    $sql->close();
    $conn->close();
}
?>

