<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Washing Machine Database Administration Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Washing Machine Database Administration</h4>
          </div>
          <div class="card-body">
            <?php
              session_start(); 
              include_once('config.php');
              if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
                $username = $_POST['username'];
                $password = $_POST['password'];

                $result = $conn->query("SELECT ID FROM Department WHERE Username='$username' AND Password='$password'");
                if ($result->num_rows == 1) {
                  $row = $result->fetch_assoc();
                  $_SESSION['ID'] = $row['ID'];
                  if('Fabricator' == $username)
                    header("Location: Fabricator_dashboard.php"); 
                  else if('Sub_Assembly' == $username)
                    header("Location: Sub_Assembly_dashboard.php");      
                  else if('Assembly' == $username)
                    header("Location: Assembly_dashboard.php");
                  else 
                    header("Location: admin_dashboard.php");
                } else {
                  echo '<div class="alert alert-danger">Invalid username or password.</div>';
                }
              }
            ?>
            <form method="POST">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
