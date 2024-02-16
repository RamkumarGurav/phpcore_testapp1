<?php

session_start();


if (!isset($_SESSION['user'])) {
  header("Location: http://localhost/xampp/MARS/testapp");
  exit();
}



if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: http://localhost/xampp/MARS/testapp");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    welcome
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

  <div class="container mx-auto mt-4">
    <h2>Welcome,
      <?= $_SESSION['user']['name'] ?>
    </h2>
    <form action="welcome.php" method="post">
      <button type="submit" class="btn btn-primary" name="logout">Logout</button>
    </form>
  </div>


</body>

</html>