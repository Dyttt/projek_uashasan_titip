<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
      max-width: 400px;
      width: 100%;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
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

    .btn-group {
      margin-top: 20px;
      text-align: center;
    }

    .btn-group button {
      margin: 0 5px;
    }
  </style>
</head>
<body>

  <form method="post" action="handle_login.php" onsubmit="return handleLogin()">
    <label for="User_Member">Username:</label>
    <input type="text" id="User_Member" name="User_Member" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <div class="btn-group">
      <button type="submit" name="submit">Login</button>

      <button type="button" onclick="deleteData()">Delete</button>
    </div>
  </form>

  <script>
    function handleLogin() {
      // Logika validasi login
      var userMemberInput = document.getElementById('User_Member');
      var passwordInput = document.getElementById('password');

      // (Lakukan validasi login sesuai kebutuhan)

      // Redirect ke Data.php setelah login berhasil
      window.location.href = 'Data.php';
      return false;  // Hindari pengiriman formulir
    }



    function deleteData() {    
      var userMemberInput = document.getElementById('User_Member');
      var passwordInput = document.getElementById('password');

      // Menghapus nilai dari input
      userMemberInput.value = '';
      passwordInput.value = '';

      alert('Data berhasil dihapus');
    }
  </script>

</body>
</html>
