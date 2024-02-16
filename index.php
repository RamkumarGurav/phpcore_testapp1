<?php
session_start();
if (isset($_SESSION['user'])) {
  header("Location: http://localhost/xampp/MARS/testapp/welcome.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost";
  $server_username = "root";
  $server_password = "";
  $dbname = "appolo_album_db";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $result = $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {



      $_SESSION['user'] = ["name" => $user["name"], "email" => $user["email"]];
      header("Location: http://localhost/xampp/MARS/testapp/welcome.php");

    } else {
      $error_msg = "Invalid email or password. Please try again.";
    }




  } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }

  $conn = null;
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
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>




</body>

</html>