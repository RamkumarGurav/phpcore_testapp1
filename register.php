<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost";
  $serverUserName = "root";
  $serverPassword = "";
  $dbname = "appolo_album_db";
  $conn = new mysqli($servername, $serverUserName, $serverPassword, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];


  $sql="INSERT INTO user (name,email,password) VALUES($name,$email,$password)";
  $result = $conn->query($sql);





  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    session_start();
    $_SESSION['user'] = ["name" => $user["name"], "email" => $user["email"]];
    header("Location: http://localhost/xampp/MARS/myPrj/welcome.php");



  } else {
    $error_msg = "Invalid email or password. Please try again.";
  }

  // Close connection
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    home
  </title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    :root {
      box-sizing: border-box;
    }

    .bg-green {
      background-color: green;
    }
  </style>


</head>

<body>


  <div class=" mx-auto mt-4 " style="max-width:500px;">
    <h2 class="text-center">Login</h2>
    <?php if (isset($error_msg)): ?>
      <p class="bg-white p-2 text-danger   rounded ">Error:
        <?= $error_msg ?>
      </p>
    <?php endif; ?>
    <form action="index.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="name" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary">register</button>
    </form>
  </div>




</body>

</html>