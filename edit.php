<!-- edit.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('img/397x300/03.jpg');
      background-size: cover;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
        align-items: center;
      max-width: 400px;
      width: 100%;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #4caf50;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "NextGen";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_member'])) {
      $id_member = $_POST['id_member'];
      $new_user = $_POST['new_user'];
      $new_email = $_POST['new_email'];
      $new_no_tlp = $_POST['new_no_tlp'];

      $sql = $conn->prepare("UPDATE member SET User_Member=?, emile=?, no_tlp=? WHERE id_member=?");
      $sql->bind_param("sssi", $new_user, $new_email, $new_no_tlp, $id_member);

      if ($sql->execute()) {
          echo "Data berhasil diubah.";
      } else {
          echo "Error: " . $sql->error;
      }

      $sql->close();
  }

  if (isset($_GET['id'])) {
      $id_member = $_GET['id'];
      $sql = $conn->prepare("SELECT * FROM member WHERE id_member = ?");
      $sql->bind_param("i", $id_member);
      $sql->execute();

      $result = $sql->get_result();
      $row = $result->fetch_assoc();

      $sql->close();
  }

  $conn->close();
  ?>

  <form method="post" action="">
    <input type="hidden" name="id_member" value="<?php echo $row['id_member']; ?>">

    <label for="new_user">New Username:</label>
    <input type="text" id="new_user" name="new_user" value="<?php echo $row['User_Member']; ?>" required>

    <label for="new_email">New Email:</label>
    <input type="email" id="new_email" name="new_email" value="<?php echo $row['emile']; ?>" required>

    <label for="new_no_tlp">New Phone Number:</label>
    <input type="text" id="new_no_tlp" name="new_no_tlp" value="<?php echo $row['no_tlp']; ?>" required>

    <button type="submit" name="submit">Update</button>
  </form>

</body>
</html>
