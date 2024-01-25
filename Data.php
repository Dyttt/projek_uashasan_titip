<!-- Data.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Member</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #4caf50;
      color: white;
    }

    .btn-group {
      display: flex;
    }

    .btn-group button {
      margin-right: 5px;
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      cursor: pointer;
    }

    .btn-group button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <h2>Data Member</h2>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "NextGen";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
  }

  // Ambil data dari tabel member
  $sql = "SELECT * FROM member";
  $result = $conn->query($sql);

  // Jika ada data, tampilkan dalam tabel
  if ($result && $result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>ID</th><th>Nama Member</th><th>Email</th><th>No. Telepon</th><th>Aksi</th></tr>";

      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id_member"] . "</td>";
          echo "<td>" . $row["User_Member"] . "</td>";
          echo "<td>" . $row["emile"] . "</td>";
          echo "<td>" . $row["no_tlp"] . "</td>";
          echo "<td class='btn-group'>";
          echo "<button onclick='editData(" . $row["id_member"] . ")'>Edit</button>";
          echo "<button onclick='deleteData(" . $row["id_member"] . ")'>Delete</button>";
          echo "</td>";
          echo "</tr>";
      }

      echo "</table>";
  } else {
      echo "Tidak ada data member.";
  }

  $conn->close();
  ?>

  <script>
    function editData(id) {
      // Redirect ke halaman edit dengan mengirim ID sebagai parameter
      window.location.href = 'edit.php?id=' + id;
    }

    function deleteData(id) {
      // Konfirmasi pengguna sebelum menghapus
      if (confirm('Apakah Anda yakin ingin menghapus data dengan ID: ' + id + '?')) {
          // Kirim permintaan AJAX ke file backend (handle_delete.php)
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
              if (xhr.readyState == 4 && xhr.status == 200) {
                  // Tampilkan pesan hasil penghapusan
                  alert(xhr.responseText);
                  // Refresh halaman setelah penghapusan berhasil
                  location.reload();
              }
          };
          xhr.open("GET", "handle_delete.php?id=" + id, true);
          xhr.send();
      }
    }
  </script>

</body>
</html>
