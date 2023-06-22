<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Washing Machine Database Administration Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('wash2.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      font-family: sans-serif;
      font-size: 50px;
    }

    .login-box {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      padding: 30px;
      background: rgba(0, 0, 0, 0.75);
      box-sizing: border-box;
      box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
      border-radius: 10px;
      opacity: 1;
    }

    .login-box h2 {
      margin: 0 0 10px;
      padding: 0;
      color: #fff;
      text-align: center;
    }

    .login-box .user-box {
      position: relative;
    }

    .login-box .user-box input {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      margin-bottom: 10px;
      border: none;
      border-bottom: 1px solid #fff;
      outline: none;
      background: transparent;
    }

    .login-box .user-box label {
      position: absolute;
      top: 0;
      left: 0;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      pointer-events: none;
      transition: .5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
      top: -10px;
      left: 0;
      color: #03e9f4;
      font-size: 12px;
    }

    .login-box .btn-login {
      position: relative;
      display: block;
      margin: 0 auto;
      padding: 10px 20px;
      color: #fff;
      font-size: 16px;
      text-decoration: none;
      text-transform: uppercase;
      overflow: hidden;
      transition: .5s;
      letter-spacing: 4px;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
    }

    .login-box .btn-login:hover {
      background-color: #0056b3;
    }

    .login-box .btn-login:before {
      content: "";
      position: absolute;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      transition: .5s;
    }

    .login-box .btn-login:hover:before {
      left: 100%;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  include_once "connect/config.php";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $conn->query(
      "SELECT ID FROM Department WHERE Username='$username' AND Password='$password'"
    );
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $_SESSION["ID"] = $row["ID"];
      if ("Fabricator" == $username) {
        header("Location:  Fabricator/Fabricator_dashboard.php");
      } elseif ("Sub_Assembly" == $username) {
        header("Location: SubAssembly/Sub_Assembly_dashboard.php");
      } elseif ("Assembly" == $username) {
        header("Location: Assembly/Assembly_dashboard.php");
      } else {
        header("Location: admin_dashboard.php");
      }
    } else {
      echo "<script>alert('Incorrect Username or Password')</script>";
    }
  }
  ?>
  <div class="login-box">
    <h2>Washing Machine Database Management</h2>
    <form method="POST">
      <div class="user-box">
        <input type="text" id="username" name="username" required>
        <label for="username">Username</label>
      </div>
      <div class="user-box">
        <input type="password" id="password" name="password" required>
        <label for="password">Password</label>
      </div>
      <button type="submit" class="btn-login">Login</button>
    </form>
  </div>
</body>

</html>
